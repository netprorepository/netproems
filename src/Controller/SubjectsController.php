<?php

  namespace App\Controller;

  use App\Controller\AppController;

  /**
   * Subjects Controller
   *
   * @property \App\Model\Table\SubjectsTable $Subjects
   *
   * @method \App\Model\Entity\Subject[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
   */
  class SubjectsController extends AppController {

      /**
       * Index method
       *
       * @return \Cake\Http\Response|void
       */
      public function index() {
          $this->paginate = [
              'contain' => ['Departments', 'Users']
          ];
          $subjects = $this->paginate($this->Subjects);

          $this->set(compact('subjects'));
      }

      /**
       * View method
       *
       * @param string|null $id Subject id.
       * @return \Cake\Http\Response|void
       * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
       */
      public function viewsubject($id = null) {
          $subject = $this->Subjects->get($id, [
              'contain' => ['Departments', 'Teachers']
          ]);
          
          $this->set('subject', $subject);
          $this->viewBuilder()->setLayout('adminbackend');
      }

      /**
       * Add method
       *
       * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
       */
      public function newsubject() {
          $subject = $this->Subjects->newEntity();
          if ($this->request->is('post')) {
              $subject = $this->Subjects->patchEntity($subject, $this->request->getData());
              $subject->user_id = $this->Auth->user('id');
              if ($this->Subjects->save($subject)) {
                  //log activity
                $usercontroller = new UsersController();
               
                 $title = "Added a new subject ".$subject->name;
                $user_id = $this->Auth->user('id');
                $description = "Created a new Subject " . $subject->name;
                $ip = $this->request->clientIp();
                $type = "Add";
                $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
                  $this->Flash->success(__('The subject has been saved.'));

                  return $this->redirect(['action' => 'managesubjects']);
              }
              $this->Flash->error(__('The subject could not be saved. Please, try again.'));
          }
          $departments = $this->Subjects->Departments->find('list', ['limit' => 200]);
        $students = $this->Subjects->Students->find('list', ['limit' => 200]);
        $teachers = $this->Subjects->Teachers->find('list', ['limit' => 200]);
        $this->set(compact('subject', 'users', 'departments', 'students', 'teachers'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      /**
       * Edit method
       *
       * @param string|null $id Subject id.
       * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
       * @throws \Cake\Network\Exception\NotFoundException When record not found.
       */
      public function updatesubject($id = null) {
          $subject = $this->Subjects->get($id, [
              'contain' => ['Departments','Teachers']
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
              $subject = $this->Subjects->patchEntity($subject, $this->request->getData());
              if ($this->Subjects->save($subject)) {
                   //log activity
                $usercontroller = new UsersController();
               
                 $title = "Updated a subject ".$subject->name;
                $user_id = $this->Auth->user('id');
                $description = "Updated a Subject " . $subject->name;
                $ip = $this->request->clientIp();
                $type = "Edit";
                $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
                  $this->Flash->success(__('The subject has been updated.'));

                  return $this->redirect(['action' => 'managesubjects']);
              }
              $this->Flash->error(__('The subject could not be saved. Please, try again.'));
          }
          $departments = $this->Subjects->Departments->find('list', ['limit' => 200]);
        $students = $this->Subjects->Students->find('list', ['limit' => 200]);
        $teachers = $this->Subjects->Teachers->find('list', ['limit' => 200]);
        $this->set(compact('subject', 'users', 'departments', 'students', 'teachers'));

          $this->viewBuilder()->setLayout('adminbackend');
      }

      /**
       * Delete method
       *
       * @param string|null $id Subject id.
       * @return \Cake\Http\Response|null Redirects to index.
       * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
       */
      public function delete($id = null) {
          $this->request->allowMethod(['post', 'delete']);
          $subject = $this->Subjects->get($id);
          if ($this->Subjects->delete($subject)) {
               //log activity
                $usercontroller = new UsersController();
               
                 $title = "Deleted a subject ".$subject->name;
                $user_id = $this->Auth->user('id');
                $description = "Deleted a Subject " . $subject->name;
                $ip = $this->request->clientIp();
                $type = "Delete";
                $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
              $this->Flash->success(__('The subject has been deleted.'));
          } else {
              $this->Flash->error(__('The subject could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'managesubjects']);
      }

      public function managesubjects() {
          $this->paginate = [
              'contain' => ['Departments', 'Users']
          ];
          $subjects = $this->paginate($this->Subjects);

          $this->set(compact('subjects'));

          $this->viewBuilder()->setLayout('adminbackend');
      }

      public function changesubjectstatus($id, $status) {
          $subjects = $this->Subjects->get($id);
          $subjects->status = $status;
      
          if ($this->Subjects->save($subjects)) {
              $this->Flash->success(__('Subject status has been changed'));
          } else {
              $this->Flash->error(__('Unable to change Subjects status. Please, try again.'));
          }
          return $this->redirect(['controller' => 'Subjects', 'action' => 'managesubjects']);
      }

  }
  