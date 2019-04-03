<?php

  namespace App\Controller;

  use Cake\ORM\TableRegistry;
  use App\Controller\AppController;

  /**
   * Teachers Controller
   *
   * @property \App\Model\Table\TeachersTable $Teachers
   *
   * @method \App\Model\Entity\Teacher[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
   */
  class TeachersController extends AppController {

      /**
       * Index method
       *
       * @return \Cake\Http\Response|void
       */
      public function manageteachers() {
          $this->paginate = [
              'contain' => ['Users', 'Countries', 'States']
          ];
          $teachers = $this->paginate($this->Teachers);
          //used for assigning subjects to a teacher in the modal
          $subjects = $this->Teachers->Subjects->find('list', ['limit' => 200]);
          $users = $this->Teachers->Users->find('list', ['limit' => 200])->where(['role_id' => 3]);

          $this->set(compact('teachers', 'subjects', 'users'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      /**
       * View method
       *
       * @param string|null $id Teacher id.
       * @return \Cake\Http\Response|void
       * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
       */
      //admin method for viewing a teacher detail
      public function viewteacher($id = null) {
          $teacher = $this->Teachers->get($id, [
              'contain' => ['Users', 'Countries', 'States', 'Subjects', 'Users.Departments']
          ]);

          //used for subject assignment
          $subjects = $this->Teachers->Subjects->find('list', ['limit' => 200]);
          $this->set('teacher', $teacher);
          $this->set('subjects', $subjects);
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //teachers method for viewing their profile
      public function viewprofile() {
          $teacher = $this->Teachers->find()->where(['user_id' => $this->Auth->user('id')])
                          ->contain(['Users', 'Countries', 'States', 'Subjects', 'Users.Departments'])->first();

          $this->set('teacher', $teacher);
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //method for downloading a teacher's cv
      public function downloadcv($id) {
          $teacher = $this->Teachers->get($id);
          if (!empty($teacher)) {
              $ext = pathinfo($teacher->cv, PATHINFO_EXTENSION);
              //  debug(json_encode(filesize("cvs/" . $teacher->cv), JSON_PRETTY_PRINT));
              //  exit;
              header('Content-Type: ' . $ext);
              header('Content-Length: ' . filesize("cvs/" . $teacher->cv));
              header('Content-Disposition: attachment;filename="' . $teacher->cv . '"');
              header("Cache-control: private");
          }
          
          readfile("cvs/" . $teacher->cv);
          return;
      }

      /**
       * Add method
       *
       * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
       */
      public function newteacher() {
          $teacher = $this->Teachers->newEntity();
          if ($this->request->is('post')) {
              $teacher = $this->Teachers->patchEntity($teacher, $this->request->getData());
              if ($this->Teachers->save($teacher)) {
                  //log activity
                  $usercontroller = new UsersController();

                  $title = "Added a new Teacher " . $teacher->id;
                  $user_id = $this->Auth->user('id');
                  $description = "Added a new Teacher with user id : " . $teacher->user_id;
                  $ip = $this->request->clientIp();
                  $type = "Add";
                  $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
                  $this->Flash->success(__('The teacher has been saved.'));

                  return $this->redirect(['action' => 'manageteachers']);
              }
              $this->Flash->error(__('The teacher could not be saved. Please, try again.'));
          }
          $users = $this->Teachers->Users->find('list', ['limit' => 200]);
          $countries = $this->Teachers->Countries->find('list', ['limit' => 200]);
          $states = $this->Teachers->States->find('list', ['limit' => 200]);
          $subjects = $this->Teachers->Subjects->find('list', ['limit' => 200]);
          $this->set(compact('teacher', 'users', 'countries', 'states', 'subjects'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //the teachers dashboard
      public function dashboard() {
          $teacher = $this->Teachers->find()->where(['user_id' => $this->Auth->user('id')])->first();
          if (empty($teacher)) {
              $this->Flash->error(__('Sorry, you need to set up your profile first.'));

              return $this->redirect(['action' => 'newprofile']);
          } else {
              $this->Flash->success(__('Welcome!.'));
          }
          $this->set(compact('teacher'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //for a first time teacher login
      public function newprofile() {
          $teacher = $this->Teachers->newEntity();
          if ($this->request->is('post')) {

              $teacher = $this->Teachers->patchEntity($teacher, $this->request->getData());
              $teacher->user_id = $this->Auth->user('id');
              //upload passport
              $imagearray = $this->request->getData('passports');
              if (!empty($imagearray['tmp_name'])) {
                  $userscontroller = new UsersController();
                  $image_name = $userscontroller->addimage($imagearray);
                  //update passport on users table
                  $usersTable = TableRegistry::get('Users');
                  $user = $usersTable->get($this->Auth->user('id'));
                  $user->passport = $image_name;
                  $usersTable->save($user);
              } else {
                  $image_name = " ";
              }
              $teacher->passport = $image_name;
              //upload CV
              $cvfile = $this->request->getData('ccv');
              if (!empty($cvfile['tmp_name'])) {
                  $cv = $userscontroller->uploadcv($cvfile, "cvs/");
                  $teacher->cv = $cv;
              }
              // debug(json_encode( $teacher, JSON_PRETTY_PRINT)); exit;
              if ($this->Teachers->save($teacher)) {
                  //log activity
                  $usercontroller = new UsersController();

                  $title = "Updated a teacher " . $teacher->id;
                  $user_id = $this->Auth->user('id');
                  $description = "updated teacher with user id : " . $teacher->user_id;
                  $ip = $this->request->clientIp();
                  $type = "Edit";
                  $usercontroller->makeLog($title, $user_id, $description, $ip, $type);

                  $this->Flash->success(__('The teacher has been saved.'));

                  return $this->redirect(['action' => 'dashboard']);
              }
              $this->Flash->error(__('The teacher could not be saved. Please, try again.'));
          }
          // $users = $this->Teachers->Users->find('list', ['limit' => 200]);
          $countries = $this->Teachers->Countries->find('list', ['limit' => 200]);
          $states = $this->Teachers->States->find('list', ['limit' => 200]);
          $this->set(compact('teacher', 'users', 'countries', 'states'));

          $this->viewBuilder()->setLayout('login');
      }

      //teachers method updating their profile
      public function updateprofile() {
          //$teacher = $this->Teachers->get($id, [ 'contain' => []]);
          $teacher = $this->Teachers->find()
                          ->contain(['States', 'Countries'])
                          ->where(['user_id' => $this->Auth->user('id')])->first();
          if ($this->request->is(['patch', 'post', 'put'])) {
              //upload passport
              $userscontroller = new UsersController();
              $imagearray = $this->request->getData('passports');
              if (!empty($imagearray['tmp_name'])) {

                  $image_name = $userscontroller->addimage($imagearray);
                  //update passport on users table
                  $usersTable = TableRegistry::get('Users');
                  $user = $usersTable->get($this->Auth->user('id'));
                  $user->passport = $image_name;
                  $usersTable->save($user);
              }
              //upload CV
              $cvfile = $this->request->getData('ccv');
              if (!empty($cvfile['tmp_name'])) {
                  $cv = $userscontroller->uploadcv($cvfile, "cvs/");
              }

              $teacher = $this->Teachers->patchEntity($teacher, $this->request->getData());
              $teacher->cv = $cv;
              if ($this->Teachers->save($teacher)) {
                  //log activity
                  $usercontroller = new UsersController();

                  $title = "Updated a teacher " . $teacher->id;
                  $user_id = $this->Auth->user('id');
                  $description = "updated teacher with user id : " . $teacher->user_id;
                  $ip = $this->request->clientIp();
                  $type = "Edit";
                  $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
                  $this->Flash->success(__('Record has been updated.'));

                  return $this->redirect(['action' => 'dashboard']);
              }
              $this->Flash->error(__('The teacher could not be updated. Please, try again.'));
          }
          // $users = $this->Teachers->Users->find('list', ['limit' => 200]);
          $countries = $this->Teachers->Countries->find('list', ['limit' => 200]);
          $states = $this->Teachers->States->find('list', ['limit' => 200]);
          $subjects = $this->Teachers->Subjects->find('list', ['limit' => 200]);
          $this->set(compact('teacher', 'users', 'countries', 'states', 'subjects'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      /**
       * Edit method
       *
       * @param string|null $id Teacher id.
       * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
       * @throws \Cake\Network\Exception\NotFoundException When record not found.
       */
      //admin method for updating a teacher
      public function updateteacher($id = null) {
          $teacher = $this->Teachers->get($id, [
              'contain' => ['Subjects']
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
              $teacher = $this->Teachers->patchEntity($teacher, $this->request->getData());
              if ($this->Teachers->save($teacher)) {
                  //log activity
                  $usercontroller = new UsersController();

                  $title = "Updated a teacher " . $teacher->id;
                  $user_id = $this->Auth->user('id');
                  $description = "updated teacher with user id : " . $teacher->user_id;
                  $ip = $this->request->clientIp();
                  $type = "Edit";
                  $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
                  $this->Flash->success(__('The teacher details has been updated successfully.'));

                  return $this->redirect(['action' => 'manageteachers']);
              }
              $this->Flash->error(__('The teacher could not be saved. Please, try again.'));
          }
          $users = $this->Teachers->Users->find('list', ['limit' => 200]);
          $countries = $this->Teachers->Countries->find('list', ['limit' => 200]);
          $states = $this->Teachers->States->find('list', ['limit' => 200]);
          $subjects = $this->Teachers->Subjects->find('list', ['limit' => 200]);
          $this->set(compact('teacher', 'users', 'countries', 'states', 'subjects'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //assigns subjects to teachers
      public function assignsubjects() {
          $teacher_id = $this->request->getData('teacher_id');
          $teacher_user_id = $this->request->getData('user_id');
          if (!empty($teacher_id)) {
              $teacher = $this->Teachers->get($teacher_id);
          } else { //echo  $teacher_user_id; exit;
              $teacher = $this->Teachers->find()->where(['user_id' => $teacher_user_id])->first();
          }
          // debug(json_encode($teacher, JSON_PRETTY_PRINT)); exit;
          $teacher = $this->Teachers->patchEntity($teacher, $this->request->getData());
          if ($this->Teachers->save($teacher)) {
              //log activity
              $usercontroller = new UsersController();

              $title = "Updated a teacher " . $teacher->id;
              $user_id = $this->Auth->user('id');
              $description = "Assigned subjects to teacher with user id : " . $teacher->user_id;
              $ip = $this->request->clientIp();
              $type = "Edit";
              $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
              $this->Flash->success(__('The subjects has been assigned successfully.'));

              return $this->redirect(['action' => 'manageteachers']);
          }
          $this->Flash->error(__('Unable to assign subjects. Please try again'));
          return $this->redirect(['action' => 'manageteachers']);
      }

      //assign subjects to teachers
      public function assignsubjectstoteacher() {

          $users_Table = TableRegistry::get('Users');
          $users = $users_Table->find('list')->where(['role_id' => 3]);

          $subjects = $this->Teachers->Subjects->find('list', ['limit' => 200]);
          $this->set(compact('users', 'subjects'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      /**
       * Delete method
       *
       * @param string|null $id Teacher id.
       * @return \Cake\Http\Response|null Redirects to index.
       * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
       */
      public function delete($id = null) {
          $this->request->allowMethod(['post', 'delete']);
          $teacher = $this->Teachers->get($id);
          if ($this->Teachers->delete($teacher)) {
              //log activity
              $usercontroller = new UsersController();

              $title = "Deleted a teacher " . $teacher->id;
              $user_id = $this->Auth->user('id');
              $description = "Deleted teacher with user id : " . $teacher->user_id;
              $ip = $this->request->clientIp();
              $type = "Delete";
              $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
              $this->Flash->success(__('The teacher has been deleted.'));
          } else {
              $this->Flash->error(__('The teacher could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'manageteachers']);
      }

  }
