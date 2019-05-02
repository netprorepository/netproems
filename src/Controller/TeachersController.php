<?php

  namespace App\Controller;
 use Cake\Routing\Router;
  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\IOFactory;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
  use PhpOffice\PhpSpreadsheet\Helper;
  use Cake\Mailer\Email;
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
              'contain' => ['Users', 'Countries', 'States', 'Subjects', 'Departments']
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
              
              $email = $this->request->getData('username');
              $fname = $this->request->getData('firstname');
              $lname = $this->request->getData('lastname');
              $mname = $this->request->getData('middlename');
              $user_id = $this->getlogindetails($email, $fname, $lname, $mname);
              if(is_numeric($user_id)){
                     //upload passport
           $imagearray = $this->request->getData('passports');
            if (!empty($imagearray['tmp_name'])) {
                $userscontroller = new UsersController();
                $image_name = $userscontroller->addimage($imagearray);
            } else {
                $image_name = '';
            }
            //upload CV
              $cvfile = $this->request->getData('cvv');
              if(!empty($cvfile['tmp_name'])) {
                  $cv = $userscontroller->uploadcv($cvfile, "cvs/");
                  $teacher->cv = $cv;
              }else{
              $cv = "";    
              }
              $teacher = $this->Teachers->patchEntity($teacher, $this->request->getData());
              $teacher->user_id = $user_id;
              $teacher->passport = $image_name;
              $teacher->cv = $cv;
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
          }}
              $this->Flash->error(__('The teacher could not be saved. Please, try again.'));
          }
          $departments = $this->Teachers->Departments->find('list', ['limit' => 200]);
          $users = $this->Teachers->Users->find('list', ['limit' => 200]);
          $countries = $this->Teachers->Countries->find('list', ['limit' => 200]);
          $states = $this->Teachers->States->find('list', ['limit' => 200]);
          $subjects = $this->Teachers->Subjects->find('list', ['limit' => 200]);
          $this->set(compact('teacher', 'users', 'countries', 'states', 'subjects','departments'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      
        //method that creates login details for the new teacher
      private function getlogindetails($email, $fname, $lname, $mname) {
          $users_Table = TableRegistry::get('Users');
          $user = $users_Table->newEntity();
          $user->role_id = 3;
          $user->password = "teacher123";
          $user->username = $email;
          $user->fname = $fname;
          $user->lname = $lname;
          $user->mname = $mname;
          if ($users_Table->save($user)) {
              return $user->id;
          } else {
              return "Failed";
          }
      }
      
      
      
      //the teachers dashboard
      public function dashboard() {
          $teacher = $this->Teachers->find()
                  ->contain(['Subjects','Departments','Departments.Students','Departments.Subjects'])
                  ->where(['user_id' => $this->Auth->user('id')])->first();
          if (empty($teacher)) {
              $this->Flash->error(__('Sorry, you need to set up your profile first.'));

              return $this->redirect(['action' => 'newprofile']);
          } else {
              $this->Flash->success(__('Welcome!.'));
               $student_Table = TableRegistry::get('Students');
               $students = $student_Table->find()->where(['status'=>'Admitted'])->count();
          }
          $this->set(compact('teacher','students'));
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
                  $teacher->cv = $cv;
              }

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

      //method that shows the teacher only her assigned courses
      public function assignedcourses() {
          $teacher = $this->Teachers->find()
                          ->where(['user_id' => $this->Auth->user('id')])
                          ->contain(['Subjects'])->first();

          $this->set('teacher', $teacher);
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //teachers method for addint a topic to a course
      public function addtopic($subject_id) {
          $topics_Table = TableRegistry::get('Topics');
          $subjects_Table = TableRegistry::get('Subjects');
          $subject = $subjects_Table->get($subject_id);
          $topic = $topics_Table->newEntity();
          if ($this->request->is('post')) {
              $topic = $topics_Table->patchEntity($topic, $this->request->getData());
              $topic->user_id = $this->Auth->user('id');
              $topic->subject_id = $subject_id;

              if ($topics_Table->save($topic)) {
                  //log activity
                  $usercontroller = new UsersController();

                  $title = "Added a Topic " . $topic->title;
                  $user_id = $this->Auth->user('id');
                  $description = "Added a Topic " . $topic->title;
                  $ip = $this->request->clientIp();
                  $type = "Add";
                  $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
                  $this->Flash->success(__('The topic has been saved.'));

                  return $this->redirect(['action' => 'assignedcourses']);
              }
              $this->Flash->error(__('The topic could not be saved. Please, try again.'));
          }
          $subjects = $this->Teachers->Subjects->find('list', ['limit' => 200]);
          // $admins = $this->Topics->Admins->find('list', ['limit' => 200]);
          $this->set(compact('topic', 'subjects', 'subject'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //shows the teacher all her topics
      public function mytopics() {
          $topics_Table = TableRegistry::get('Topics');
          $mytopics = $topics_Table->find()
                  ->where(['Topics.user_id' => $this->Auth->user('id')])
                  ->contain(['Subjects']);
          //     debug(json_encode($mytopics, JSON_PRETTY_PRINT)); exit;
          $this->set('mytopics', $mytopics);
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //teachers method for updating a topic
      public function updatetopic($id) {
          $topics_Table = TableRegistry::get('Topics');
          $topic = $topics_Table->get($id, [
              'contain' => ['Subjects']
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
              $topic = $topics_Table->patchEntity($topic, $this->request->getData());
              $topic->updatedon = date('d M Y');
              if ($topics_Table->save($topic)) {
                  //log activity
                  $usercontroller = new UsersController();

                  $title = "Updated a Topic " . $topic->title;
                  $user_id = $this->Auth->user('id');
                  $description = "Updated a Topic " . $topic->title;
                  $ip = $this->request->clientIp();
                  $type = "Edit";
                  $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
                  $this->Flash->success(__('The topic has been updated.'));

                  return $this->redirect(['action' => 'mytopics']);
              }
              $this->Flash->error(__('The topic could not be updated. Please, try again.'));
          }
          $subjects = $topics_Table->Subjects->find('list', ['limit' => 200]);
          // $admins = $this->Topics->Admins->find('list', ['limit' => 200]);
          $this->set(compact('topic', 'subjects'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //techers method for viewing a topic
      public function viewtopic($id) {
          $topics_Table = TableRegistry::get('Topics');
          $topic = $topics_Table->get($id, [
              'contain' => ['Subjects']
          ]);
          $this->set('topic', $topic);
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

      //admin method for sending messages to teachers
      public function newmessagetoteachers() {
          $usersTable = TableRegistry::get('Users');
          if ($this->request->is('post')) {
              $teachers_ids = $this->request->getData('user._ids');

              $subject = $this->request->getData('subject');
              $message = $this->request->getData('message');
              $count = 0;
              //check if a teacher was selected
              if (!empty($teachers_ids)) {
                  //some teachers have been selected, send to them alone
                  foreach ($teachers_ids as $tid) {
                      $teacher_mail = $usersTable->get($tid);
                      $this->messagetoteachers($teacher_mail->username, $subject, $message);
                      $count++;
                  }
              } else { //no employee was selected that means we are sending to all 
                  $employees = $usersTable->find()->where(['role_id' => 3]);
                  foreach ($employees as $employee) {
                      $this->messagetoteachers($employee->username, $subject, $message);
                      $count++;
                  }
              }
              //log activity
              $usercontroller = new UsersController();

              $title = "Sent a mail to employees ";
              $user_id = $this->Auth->user('id');
              $description = "Sent mail to a total of" . $count . " employees ";
              $ip = $this->request->clientIp();
              $type = "Add";
              $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
              $this->Flash->success(__('Message has been sent to ' . $count . ' employees'));
              return $this->redirect(['action' => 'newmessagetoteachers']);
          }

          $teachers = $usersTable->find('list')->where(['role_id' => 3]);
          $this->set(compact('teachers'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //admin method that sends a message to selected employees
      private function messagetoteachers($emailaddress, $subject, $message) {

          $message .= '<br /><br />'
                  . 'Kind Regards,<br />'
                  . 'NetPro EMS. <br />';

          $email = new Email('default');
          $email->setFrom(['no-reply@netpro.com.ng' => 'NetPro Int\'l Ltd']);
          $email->setTo($emailaddress);
          // $email->setBcc(['chukwudi@netpro.com.ng']);
          $email->setEmailFormat('html');
          $email->setSubject($subject);
          $email->send($message);
          return;
      }
      
      
      //teachers method for contacting the admin
      public function messagetoadmin(){
          
           if ($this->request->is('post')) {
               $subject = $this->request->getData('subject');
              $message = $this->request->getData('message');
              //get admin email from session
              $settings = $this->request->getSession()->read('settings');
              //call the mailling function
             if($this->messagetoteachers($settings->email, $subject, $message)){
                $this->Flash->success(__('Message has been sent to admin'));
              return $this->redirect(['action' => 'messagetoadmin']);  
             }else{
                $this->Flash->error(__('Sorry, unable to send message, please try again'));
              return $this->redirect(['action' => 'messagetoadmin']);  
             }
               
           }
          $this->viewBuilder()->setLayout('adminbackend');
      }
  
      
      
      //teacher method for sending mails to his students
      public function messagetostudents(){
           $studentsTable = TableRegistry::get('Students');
              $sdepartmentsTable = TableRegistry::get('Departments');
        $teacher =   $this->Teachers->find()
                ->contain(['Departments'])
                ->where(['user_id'=>$this->Auth->user('id')])->first();
         if ($this->request->is('post')) {
               $subject = $this->request->getData('subject');
              $message = $this->request->getData('message');
              $studentids = $this->request->getData('student._ids');
              if(!empty($studentids)){
                  $count = 0;
                  //he selected some students
                  foreach ($studentids as $sid){
                  $student = $studentsTable->get($sid);
                  //call the mailing method
                  $this->messagetoteachers($student->email, $subject, $message);
                  $count++;
                  }
              }else{
                  //no student was selected meaning we are sending to all students in the department
                 $students = $studentsTable->find()->where(['department_id'=> $teacher->department_id]);  
                 foreach ($students as $student){
                  //call the mailing method
                  $this->messagetoteachers($student->email, $subject, $message);
                  $count++;   
                 }
              }
              $this->Flash->success(__('Message has been sent to '.$count.' students'));
              return $this->redirect(['action' => 'messagetostudents']); 
         
         }
          $students = $studentsTable->find('list')->where(['department_id'=> $teacher->department_id]);
          $departments = $sdepartmentsTable->find('list')->where(['id'=>$teacher->department_id]);
          $this->set(compact('students','departments'));
          
            $this->viewBuilder()->setLayout('adminbackend');
      }
      
      //function that returns the states on the drop down
      public function getstates($country_id) {
          $statestable = TableRegistry::get('States');
          $states = $statestable->find('list')
                  ->where(['country_id' => $country_id]);
          $this->set(compact('states'));
          //debug(json_encode($states , JSON_PRETTY_PRINT)); exit;
      }
      
      
      //teachers method for uploading their results
      public function uploadresults(){
          $teacher = $this->Teachers->find()->contain(['Subjects'])->where(['user_id'=>$this->Auth->user('id')])->first();
         if(!$teacher){
              $this->Flash->error(__('Wrong access type'));
             return $this->redirect(['controller'=>'Students','action' => 'index']);
         }
          $resultsTable = TableRegistry::get('Results');
           if ($this->request->is(['patch', 'post', 'put'])) {
              $faculty_id = $this->request->data('faculty_id');
              $department_id = $this->request->data('department_id');
              // $program_id = $this->request->data('program_id');
              $session_id = $this->request->data('session_id');
              $semester_id = $this->request->data('semester_id');
              $course_id = $this->request->data('subject_id');


              $filename = $this->request->data['result']['name'];
              $ext = pathinfo($filename, PATHINFO_EXTENSION);
              // echo $ext; exit;
              $allowedext = ['csv', 'xlsx'];
              if ($this->request->data['result']['error']) {
                  $this->Flash->error(__('Sorry, there is a problem with the file,only csv or xlsx files can be uploaded. Please check and try again'));

                  return $this->redirect(['action' => 'uploadresults']);
              }
              if (!in_array($ext, $allowedext)) {
                  $this->Flash->error(__('Sorry, only csv or xlsx files can be uploaded.'));

                  return $this->redirect(['action' => 'uploadresults']);
              } else {
                  $helper = new Helper\Sample();
                  debug($helper);
                  $inputFileName = $this->request->data['result']['tmp_name'];
                  $spreadsheet = IOFactory::load($inputFileName);
                  $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                  $count = 0;
                  $inserted = 0;
                  $duplicate_results = 0;
                  $unknown_students = 0;
                  foreach ($sheetData as $data) {

                      $count++;

                      if ($count > 1) {
                          // debug(json_encode( $data, JSON_PRETTY_PRINT)); exit;
                          //  $programe = $programes_table->get($program_id);
                          $department =  $resultsTable->Departments->get($department_id);
                          $semester =  $resultsTable->Semesters->get($semester_id);
                          $course =  $resultsTable->Subjects->get($course_id);
                          $session =  $resultsTable->Sessions->get($session_id);

//               echo strtolower(trim($semester->name)) .' '. strtolower(trim($data['H'])).'<br />';
//              echo strtolower(trim($department->name)) .' '. strtolower(trim($data['G'])).'<br />';
//             echo  strtolower(trim($programe->programname)) .' '. strtolower(trim($data['F'])).'<br />';
//             echo  strtolower(trim($course->name)) .' '. strtolower(trim($data['F'])).'<br />';
//            echo   strtolower(trim($session->name)) .' '. strtolower(trim($data['I'])).'<br />';
//            exit;
                          if (strtolower(trim($department->name)) === strtolower(trim($data['G'])) &&
                                  strtolower(trim($course->name)) === strtolower(trim($data['F'])) &&
                                  strtolower(trim($semester->name)) === strtolower(trim($data['H'])) &&
                                  strtolower(trim($session->name)) === strtolower(trim($data['I']))) {

                              //get the student and ensure no double result
                              //  debug(json_encode( $data, JSON_PRETTY_PRINT)); exit;
                              $student =  $resultsTable->Students->find()->where(['regno' => $data['A']])->first();
                              //ensure no result for this course already

                              if ($student) {

                                  $has_result =  $resultsTable->find()->where(['regno' => $data['A'],
                                      'department_id' => $department_id, 'subject_id' => $course_id, 'semester_id' => $semester_id, 'session_id' => $session_id]);
                                  if (empty($has_result->toArray())) {
                                      // debug(json_encode( $data, JSON_PRETTY_PRINT)); exit;
                                      //create a new result for this student
                                      $result =  $resultsTable->newEntity();
                                      $result->regno = $data['A'];
                                      // $result->surname = $data['B'];
                                      $result->student_id = $student->id;
                                      $result->faculty_id = $faculty_id;
                                      // $result->firstname = $data['C'];
                                      // $result->middlename = $data['D'];
                                      $result->department_id = $department_id;
                                      $result->remark = $data['E'];
                                      $result->semester_id = $semester_id;
                                      $result->subject_id = $course_id;
                                      $result->session_id = $session_id;
                                      $result->creditload = $data['D'];
                                      $result->score = $data['B'];
                                      $result->grade = $data['C'];
                                      $result->user_id = $this->Auth->user('id');
                                      // debug(json_encode($result, JSON_PRETTY_PRINT)); exit;
                                       $resultsTable->save($result);
                                      $inserted ++;
                                  } else {
                                      $duplicate_results++;
                                  }
                              } else {
                                  $unknown_students++;
                              }
                          } else {
                              $this->Flash->error('Total results uploaded : ' . $inserted . ' Some results failed to upload because selected data didnt match provided data. Please ensure the right department,'
                                      . 'course, session and faculty was selected. Duplicate results found : ' . $duplicate_results
                                      . ' Unknown students : ' . $unknown_students);
                              return $this->redirect(['action' => 'uploadresults']);
                          }

                          // debug(json_encode($data['F'], JSON_PRETTY_PRINT)); exit;
                      }
                  }
                  //log activity
                  $usercontroller = new UsersController();

                  $title = "Result Bulk Upload ";
                  $user_id = $this->Auth->user('id');
                  $description = "Uploaded " . $inserted . ' results';
                  $ip = $this->request->clientIp();
                  $type = "Add";
                  $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
                  $this->Flash->success(__($inserted . ' Result(s) have been uploaded successfully. Duplicates found : ' . $duplicate_results . ' Unknown students : ' . $unknown_students));

                  return $this->redirect(['action' => 'uploadresults']);
              }
          }
          
          //get teacher subjects
          $teacher_subjects = [];
          foreach ($teacher->subjects as $subject){
              array_push($teacher_subjects, $subject->id);
          }
          $faculties =  $resultsTable->Faculties->find('list', ['limit' => 200])
                  ->order(['name' => 'ASC']);
          $departments =  $resultsTable->Departments->find('list', ['limit' => 200])
                  ->order(['name' => 'ASC']);
          $subjects =  $resultsTable->Subjects->find('list', ['limit' => 200])
                  ->where(['id IN '=>$teacher_subjects])
                  ->order(['name' => 'ASC']);
          $semesters =  $resultsTable->Semesters->find('list', ['limit' => 200]);
          $sessions =  $resultsTable->Sessions->find('list', ['limit' => 200]);
          $this->viewBuilder()->setLayout('adminbackend');
          $this->set(compact('result', 'students', 'faculties', 'departments', 'subjects', 'semesters', 'sessions', 'users'));
      }
  
      
      
      
      //teachers method for managing his students results
      public function manageresults(){
           $teacher = $this->Teachers->find()->contain(['Subjects'])->where(['user_id'=>$this->Auth->user('id')])->first();
         if(!$teacher){
              $this->Flash->error(__('Wrong access type'));
             return $this->redirect(['controller'=>'Students','action' => 'index']);
         }
          $resultsTable = TableRegistry::get('Results');
          if ($this->request->is('post')) {
               $session_id = $this->request->data('session_id');
              $semester_id = $this->request->data('semester_id');
              $course_id = $this->request->data('subject_id');
           
              if (!empty($course_id)) {
                  $conditions['Results.subject_id'] = $course_id;
              }
              if (!empty($session_id)) {
                  $conditions['Results.session_id'] = $session_id;
              }
              if (!empty($semester_id)) {
                  $conditions['Results.semester_id'] = $semester_id;
              }

              $results = $resultsTable->find()
                      ->contain(['Students', 'Faculties', 'Departments', 'Subjects', 'Semesters', 'Sessions','Users'])
                      ->where($conditions);
              //debug(json_encode($conditions, JSON_PRETTY_PRINT)); exit;
              $this->set('results', $this->paginate($results));
          }
          
          $teacher_subjects = [];
          foreach ($teacher->subjects as $subject){
              array_push($teacher_subjects, $subject->id);
          } 
          $subjects =  $resultsTable->Subjects->find('list', ['limit' => 200])
                  ->where(['id IN '=>$teacher_subjects])
                  ->order(['name' => 'ASC']);
          $semesters =  $resultsTable->Semesters->find('list', ['limit' => 200]);
          $sessions =  $resultsTable->Sessions->find('list', ['limit' => 200]);
          $this->viewBuilder()->setLayout('adminbackend');
          $this->set(compact('result','subjects', 'semesters', 'sessions'));
    
          
      }
  
      
      
      
  }
  