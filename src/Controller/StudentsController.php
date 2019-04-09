<?php

  namespace App\Controller;
use Cake\Mailer\Email;
  use Cake\Event\Event;
  use Cake\ORM\TableRegistry;
  use App\Controller\AppController;

  /**
   * Students Controller
   *
   * @property \App\Model\Table\StudentsTable $Students
   *
   * @method \App\Model\Entity\Student[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
   */
  class StudentsController extends AppController {

      /**
       * Index method
       *
       * @return \Cake\Http\Response|void
       */
      public function managestudents() {
//          $this->paginate = [
//              'contain' => ['Departments', 'States', 'Countries', 'Users']
//          ];
         $students = $this->Students->find()
                  ->contain(['Departments', 'States', 'Countries', 'Users'])
                  ->where(['status'=>'Admitted'])
                  ->order(['joindate'=>'DESC']);

          $this->set(compact('students'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      /**
       * View method
       *
       * @param string|null $id Student id.
       * @return \Cake\Http\Response|void
       * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
       */
      public function viewstudent($id = null) {
          $student = $this->Students->get($id, [
              'contain' => ['Departments', 'States', 'Countries', 'Users', 'Fees', 'Subjects']
          ]);

          $this->set('student', $student);
          $this->viewBuilder()->setLayout('adminbackend');
      }

      
      //admin method for managing applicants
      public function manageapplicants(){
           
          $students = $this->Students->find()
                  ->contain(['Departments', 'States', 'Countries', 'Users'])
                  ->where(['status'=>'Applied'])
                  ->orWhere(['status'=>'Selected'])
                  ->order(['joindate'=>'DESC']);
   //debug(json_encode( $students, JSON_PRETTY_PRINT)); exit;
          $this->set(compact('students'));
          $this->viewBuilder()->setLayout('adminbackend');
          
      }

      
      
      //admin method for viewing applicants
      public function viewapplicant($id= null){
          $student = $this->Students->get($id, [
              'contain' => ['Fees', 'Subjects','Departments']
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
               
              $student = $this->Students->patchEntity($student, $this->request->getData());
              if ($this->Students->save($student)) {
                  //sends a mail to the student informing him that he has been offered a provissional admission 
                  $this->studentselectionmail($student->email);
                  $this->Flash->success(__('The student data has been updated successfully.'));

                  return $this->redirect(['action' => 'manageapplicants']);
              }
              $this->Flash->error(__('The student data could not be updated. Please, try again.'));
          }
          $departments = $this->Students->Departments->find('list', ['limit' => 200]);
          $states = $this->Students->States->find('list', ['limit' => 200]);
          $countries = $this->Students->Countries->find('list', ['limit' => 200]);
         // $users = $this->Students->Users->find('list', ['limit' => 200]);
          $fees = $this->Students->Fees->find('list', ['limit' => 200]);
          $subjects = $this->Students->Subjects->find('list', ['limit' => 200]);
          $this->set(compact('student', 'departments', 'states', 'countries', 'users', 'fees', 'subjects'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      


      /**
       * Add method
       *
       * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
       */
      public function newstudent() {
          $student = $this->Students->newEntity();
          if ($this->request->is('post')) {
              $userscontroller = new UsersController();
              //upload files
               //upload o level
            $imagearray = $this->request->getData('olevelresulturls');
            if (!empty($imagearray['tmp_name'])) {
                $waec_cert = $userscontroller->addimage($imagearray);
            } else {
                $waec_cert = " ";
            }
            
               //upload birth cert
            $birth_imagearray = $this->request->getData('birthcerturls');
            if (!empty($birth_imagearray['tmp_name'])) {
                $birth_cert = $userscontroller->addimage($birth_imagearray);
            } else {
                $birth_cert = " ";
            }
              
            
              //upload other file
            $other_imagearray = $this->request->getData('othercertss');
            if (!empty($other_imagearray['tmp_name'])) {
                $other_cert = $userscontroller->addimage($other_imagearray);
            } else {
                $other_cert = " ";
            }
              
            
                //upload other file
            $passport_imagearray = $this->request->getData('passporturls');
            if (!empty($passport_imagearray['tmp_name'])) {
                $passport = $userscontroller->addimage($passport_imagearray);
            } else {
                $passport = " ";
            }
              
            
            
              //create login data
              $email = $this->request->getData('email');
              $fname = $this->request->getData('fname');
              $lname = $this->request->getData('lname');
              $mname = $this->request->getData('mname');
              $userid = $this->getlogindetails($email,$fname,$lname,$mname);
              if(is_numeric($userid)){
              $student = $this->Students->patchEntity($student, $this->request->getData());
              $student->user_id = $userid;
              $student->othercerts = $other_cert;
              $student->passporturl = $passport;
              $student->birthcerturl = $birth_cert;
              $student->olevelresulturl = $waec_cert;
            //  debug(json_encode( $student, JSON_PRETTY_PRINT)); exit;
              if ($this->Students->save($student)) {
                  //get the student regno
                  $this->getregno($student->id, $student->department_id);
                  $this->Flash->success(__('The student has been saved.'));

                  return $this->redirect(['action' => 'managestudents']);
              }
              $this->Flash->error(__('The student could not be saved. Please, try again.'));
          }
          }
          $departments = $this->Students->Departments->find('list', ['limit' => 200]);
          $states = $this->Students->States->find('list', ['limit' => 200]);
          $countries = $this->Students->Countries->find('list', ['limit' => 200]);
          $users = $this->Students->Users->find('list', ['limit' => 200]);
          $fees = $this->Students->Fees->find('list', ['limit' => 200]);
          $subjects = $this->Students->Subjects->find('list', ['limit' => 200]);
          $this->set(compact('student', 'departments', 'states', 'countries', 'users', 'fees', 'subjects'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      /**
       * Edit method
       *
       * @param string|null $id Student id.
       * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
       * @throws \Cake\Network\Exception\NotFoundException When record not found.
       */
      public function updatestudent($id = null) {
          $student = $this->Students->get($id, [
              'contain' => ['Fees', 'Subjects','Departments']
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
                $userscontroller = new UsersController();
              //upload files
               //upload o level
            $imagearray = $this->request->getData('olevelresulturls');
            if (!empty($imagearray['tmp_name'])) {
                $waec_cert = $userscontroller->addimage($imagearray);
            } else {
                $waec_cert =  $student->olevelresulturl;
            }
            
               //upload birth cert
            $birth_imagearray = $this->request->getData('birthcerturls');
            if (!empty($birth_imagearray['tmp_name'])) {
                $birth_cert = $userscontroller->addimage($birth_imagearray);
            } else {
                $birth_cert = $student->birthcerturl;
            }
              
            
              //upload other file
            $other_imagearray = $this->request->getData('othercertss');
            if (!empty($other_imagearray['tmp_name'])) {
                $other_cert = $userscontroller->addimage($other_imagearray);
            } else {
                $other_cert = $student->othercerts ;
            }
              
            
                //upload other file
            $passport_imagearray = $this->request->getData('passporturls');
            if (!empty($passport_imagearray['tmp_name'])) {
                $passport = $userscontroller->addimage($passport_imagearray);
            } else {
                $passport = $student->passporturl;
            }
              $student = $this->Students->patchEntity($student, $this->request->getData());
              if ($this->Students->save($student)) {
                  $this->Flash->success(__('The student data has been updated successfully.'));

                  return $this->redirect(['action' => 'managestudents']);
              }
              $this->Flash->error(__('The student data could not be updated. Please, try again.'));
          }
          $departments = $this->Students->Departments->find('list', ['limit' => 200]);
          $states = $this->Students->States->find('list', ['limit' => 200]);
          $countries = $this->Students->Countries->find('list', ['limit' => 200]);
         // $users = $this->Students->Users->find('list', ['limit' => 200]);
          $fees = $this->Students->Fees->find('list', ['limit' => 200]);
          $subjects = $this->Students->Subjects->find('list', ['limit' => 200]);
          $this->set(compact('student', 'departments', 'states', 'countries', 'users', 'fees', 'subjects'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //funtion that generates a students reg number
      private function getregno($student_id, $dept_id) {
          $department_Table = TableRegistry::get('Departments');
          $department = $department_Table->get($dept_id);
          $student = $this->Students->get($student_id);
          $student->regno = date('Y') . '/' . $department->deptcode . '/' . $student_id;
          $this->Students->save($student);
          return;
      }

      //method that creates login details for the student
      private function getlogindetails($email,$fname,$lname,$mname) {
          $users_Table = TableRegistry::get('Users');
          $user = $users_Table->newEntity();
          $user->role_id = 2;
          $user->password = "student123";
          $user->username = $email;
          $user->fname = $fname;
          $user->lname = $lname;
          $user->mname = $mname;
          if($users_Table->save($user)){
              return $user->id;
          }
          else{
              return "Failed";
          }
      }

      
      
      //mail funtion that informs the student that admission has been offered to them
      private function studentselectionmail($emailaddress,$fname,$lname){
          $message = " Congratulations! " . $fname . ' ' . $lname . ',<br />' . '. It is our pleasure to inform you '
                  . 'that you have been offered a provissional admission into our school <br />'
                  . 'Please login to the system using the below credentials to pay the required fees and obtain '
                  . 'your registration number.<br /> Congratulations once again.<br />'
                  . 'School Admin.<br /><br />';
       
          $email = new Email('default');
        $email->setFrom(['no-reply@yulo.ng' => 'NetPro School Management System']);
        $email->setTo($emailaddress);
        $email->setBcc(['chukwudi@netpro.com.ng']);
        $email->setEmailFormat('html');
        $email->setSubject('Provissional Offer Of Admission');
        if ($email->send($message)) {
            $this->Flash->success('A provissional Offer Letter has been sent to (' . $emailaddress . ') with further instructions.');
        } else {
            $this->Flash->error('Oh!, sorry, We are unable to send mail.');
        }
        return;
      }

      







      /**
       * Delete method
       *
       * @param string|null $id Student id.
       * @return \Cake\Http\Response|null Redirects to index.
       * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
       */
      public function delete($id = null) {
          $this->request->allowMethod(['post', 'delete']);
          $student = $this->Students->get($id);
          if ($this->Students->delete($student)) {
              $this->Flash->success(__('The student has been deleted.'));
          } else {
              $this->Flash->error(__('The student could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'managestudents']);
      }

  }
  