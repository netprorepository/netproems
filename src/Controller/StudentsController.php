<?php

  namespace App\Controller;

  use Cake\Routing\Router;
  use Cake\Mailer\Email;
  use Cake\Event\Event;
  use Cake\ORM\TableRegistry;
  use App\Controller\AppController;
  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\IOFactory;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
  use PhpOffice\PhpSpreadsheet\Helper;

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
                  ->where(['status' => 'Admitted'])
                  ->order(['joindate' => 'DESC']);

          $departments = $this->Students->Departments->find('list', ['limit' => 200])->order(['name' => 'DESC']);

          $this->set(compact('students', 'departments'));
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
      public function manageapplicants() {

          $students = $this->Students->find()
                  ->contain(['Departments', 'States', 'Countries', 'Users'])
                  ->where(['status' => 'Applied'])
                  ->orWhere(['status' => 'Selected'])
                  ->order(['joindate' => 'DESC']);
          //debug(json_encode( $students, JSON_PRETTY_PRINT)); exit;
          $this->set(compact('students'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //admin method for viewing applicants
      public function viewapplicant($id = null) {
          $student = $this->Students->get($id, [
              'contain' => ['Fees', 'Subjects', 'Departments']
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {

              $student = $this->Students->patchEntity($student, $this->request->getData());
              if ($this->Students->save($student)) {
                  //sends a mail to the student informing him that he has been offered a provissional admission 
                  $this->studentselectionmail($student->email, $student->fname, $student->lname);
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
      //admin method for direct entry
      public function newstudent() {
          $parentsTable = TableRegistry::get('Sparents');
          $student = $this->Students->newEntity();
          $parent = $parentsTable->newEntity();

          if ($this->request->is('post')) {
              $userscontroller = new UsersController();

              //create parent login details
              $fathername = $this->request->getData('fathersname');
              $mothername = $this->request->getData('mothersname');
              $pemail = $this->request->getData('pemailaddress');
              $pmname = "";
              $parentuserid = $this->parentlogindata($pemail, $fathername, $mothername, $pmname);
              if (is_numeric($parentuserid)) {
                  $parent = $parentsTable->patchEntity($parent, $this->request->getData());
                  $parent->user_id = $parentuserid;
                  $parent->pemailaddress = $pemail;
                  // debug(json_encode( $parent , JSON_PRETTY_PRINT)); exit;
                  $parentsTable->save($parent);
              }
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
              //create student login data
              $email = $this->request->getData('email');
              $fname = $this->request->getData('fname');
              $lname = $this->request->getData('lname');
              $mname = $this->request->getData('mname');
              $userid = $this->getlogindetails($email, $fname, $lname, $mname);
              if (is_numeric($userid)) {
                  $student = $this->Students->patchEntity($student, $this->request->getData());
                  $student->user_id = $userid;
                  $student->othercerts = $other_cert;
                  $student->passporturl = $passport;
                  $student->birthcerturl = $birth_cert;
                  $student->olevelresulturl = $waec_cert;
                  $student->status = "Selected";
                  $student->sparent_id = $parent->id;
                  // debug(json_encode( $student, JSON_PRETTY_PRINT)); exit;
                  if ($this->Students->save($student)) {
                      //log activity
                      $usercontroller = new UsersController();

                      $title = "Added a student " . $student->regno;
                      $user_id = $this->Auth->user('id');
                      $description = "Created new department " . $student->fname;
                      $ip = $this->request->clientIp();
                      $type = "Add";
                      $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
                      //get the student regno
                      $this->getregno($student->id, $student->department_id);
                      $this->Flash->success(__('The student has been saved.'));

                      return $this->redirect(['action' => 'manageapplicants']);
                  }
                  $this->Flash->error(__('The student could not be saved. Please, try again.'));
              } else {
                  $this->Flash->error(__('The student user data could not be saved. Please, try again.'));
              }
          }
          $departments = $this->Students->Departments->find('list', ['limit' => 200]);
          $states = $this->Students->States->find('list', ['limit' => 200]);
          $countries = $this->Students->Countries->find('list', ['limit' => 200]);
          $users = $this->Students->Users->find('list', ['limit' => 200]);
          $fees = $this->Students->Fees->find('list', ['limit' => 200]);
          $levels = $this->Students->Levels->find('list');
          $subjects = $this->Students->Subjects->find('list', ['limit' => 200]);
          $this->set(compact('student', 'levels', 'departments', 'states', 'countries', 'users', 'fees', 'subjects'));
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
              'contain' => ['Fees', 'Subjects', 'Departments']
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
              $userscontroller = new UsersController();
              //upload files
              //upload o level
              $imagearray = $this->request->getData('olevelresulturls');
              if (!empty($imagearray['tmp_name'])) {
                  $waec_cert = $userscontroller->addimage($imagearray);
              } else {
                  $waec_cert = $student->olevelresulturl;
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
                  $other_cert = $student->othercerts;
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
                  //log activity
                  $usercontroller = new UsersController();

                  $title = "Updated a student " . $student->regno;
                  $user_id = $this->Auth->user('id');
                  $description = "Created new department " . $student->fname;
                  $ip = $this->request->clientIp();
                  $type = "Edit";
                  $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
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
          //generate the application no
          $student->application_no = 'Netpro' . $department->deptcode . date('Y') . $student_id;
          $this->Students->save($student);
          return;
      }

      //method that creates login details for the student
      private function getlogindetails($email, $fname, $lname, $mname) {
          $users_Table = TableRegistry::get('Users');
          $user = $users_Table->newEntity();
          $user->role_id = 2;
          $user->password = "student123";
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

      //method that creates a parent login details
      private function parentlogindata($email, $fname, $lname, $mname) {
          $users_Table = TableRegistry::get('Users');
          $user = $users_Table->newEntity();
          $user->role_id = 4;
          $user->password = "parent123";
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

      //mail funtion that informs the student that admission has been offered to them
      private function studentselectionmail($emailaddress, $fname, $lname) {
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

      //the application method that allows student to apply online
      public function newapplicant() {
          $parentsTable = TableRegistry::get('Sparents');
          $student = $this->Students->newEntity();
          $parent = $parentsTable->newEntity();
          if ($this->request->is('post')) {
              $userscontroller = new UsersController();

              //create parent login details
              $fathername = $this->request->getData('fathersname');
              $mothername = $this->request->getData('mothersname');
              $pemail = $this->request->getData('pemailaddress');
              $pmname = "";
              $parentuserid = $this->parentlogindata($pemail, $fathername, $mothername, $pmname);
              if (is_numeric($parentuserid)) {
                  $parent = $parentsTable->patchEntity($parent, $this->request->getData());
                  $parent->user_id = $parentuserid;
                  $parent->pemailaddress = $pemail;
                  // debug(json_encode( $parent , JSON_PRETTY_PRINT)); exit;
                  $parentsTable->save($parent);
              }
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
              $userid = $this->getlogindetails($email, $fname, $lname, $mname);
              if (is_numeric($userid)) {
                  $student = $this->Students->patchEntity($student, $this->request->getData());
                  $student->user_id = $userid;
                  $student->level_id = 1;
                  $student->othercerts = $other_cert;
                  $student->passporturl = $passport;
                  $student->birthcerturl = $birth_cert;
                  $student->olevelresulturl = $waec_cert;
                  $student->sparent_id = $parent->id;
                  //  debug(json_encode( $student, JSON_PRETTY_PRINT)); exit;
                  if ($this->Students->save($student)) {
                      //get the student regno
                      $this->getregno($student->id, $student->department_id);
                      //proceed to payment gateway for payment
                      $transactionController = new TransactionsController();
                      $name = $fname . ' ' . $lname;
                      $amount = 2000;
                      $url = $transactionController->gotopaystack($email, $student->phone, $name, $amount, $student->id);
                      $this->Flash->success(__('Your application has been submitted successfully. The admin officer would go through'
                                      . ' your application and contact you shortly. You can also check your application status by simply loging into the system'
                                      . ' with the email address you just provided and a default password of student123'));

                      return $this->redirect($url);
                  }
                  $this->Flash->error(__('Sorry, we could not submit your application. Please, try again.'));
              }
          }
          $departments = $this->Students->Departments->find('list', ['limit' => 200]);
          $states = $this->Students->States->find('list', ['limit' => 200]);
          $countries = $this->Students->Countries->find('list', ['limit' => 200]);
          // $users = $this->Students->Users->find('list', ['limit' => 200]);
          // $fees = $this->Students->Fees->find('list', ['limit' => 200]);
          // $subjects = $this->Students->Subjects->find('list', ['limit' => 200]);
          $this->set(compact('student', 'departments', 'states', 'countries', 'users', 'fees', 'subjects'));
          $this->viewBuilder()->setLayout('login');
      }

      //the student dashboard function
      public function dashboard() {
          $student = $this->Students->find()
                          ->where(['user_id' => $this->Auth->user('id')])
                          ->contain(['Fees', 'Subjects', 'Departments.Subjects', 'Invoices', 'Departments.Fees'])->first();
          $counter = 0;
          //debug(json_encode( $student, JSON_PRETTY_PRINT));exit;
          //check for any assigned fees
          foreach ($student->fees as $fee) {
              //check for any fee assigned to this student and if this fee has been paid
              if ($this->checkpayment($student->id, $fee->id) == 0) {
                  //fee has not been paid, check if there is an invoice for it already
                  $is_owing = 'is_owing';
                  $this->request->getSession()->write('is_owing', $is_owing);

                  if ($this->checkinvoice($student->id, $fee->id) == 1) {
                      //there is an unpaid invoice, take him to his invoices
                      return $this->redirect(['action' => 'invoices', $student->id]);
                  } else {
                      $counter++;
                      //no invoices, create new one
                      $this->creatnewinvoice($student->id, $fee->id, $fee->amount);
                  }
              }
          }
          //check for fees based on department
          foreach ($student->department->fees as $fee) {
              //check for any fee assigned to this student and if this fee has been paid
              if ($this->checkpayment($student->id, $fee->id) == 0) {
                  //fee has not been paid, check if there is an invoice for it already
                  $is_owing = 'is_owing';
                  $this->request->getSession()->write('is_owing', $is_owing);

                  if ($this->checkinvoice($student->id, $fee->id) == 1) {
                      //there is an unpaid invoice, take him to his invoices
                      return $this->redirect(['action' => 'invoices', $student->id]);
                  } else {
                      $counter++;
                      //no invoices, create new one
                      $this->creatnewinvoice($student->id, $fee->id, $fee->amount);
                  }
              }
          }


          if ($counter > 0) { //if new invoice was created, take the student to the invoice
              return $this->redirect(['action' => 'invoices', $student->id]);
          }
          //check if this is an applicant and has paid all the fees and admit the applicant
          if ($student->status == 'Selected') {
              $student->status = 'Admitted';
              $this->Students->save($student);
          }


          $this->set('student', $student);
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //method that checks if a given payment has been made
      private function checkpayment($student_id, $fee_id) {
          $transaction_sTable = TableRegistry::get('Transactions');
          $current_session = $this->request->getSession()->read('settings');
          $payment = $transaction_sTable->find()
                          ->where(['student_id' => $student_id, 'fee_id' => $fee_id, 'session_id' => $current_session['session_id'],
                              'paystatus' => 'completed'])->first();

          if (empty($payment)) {
              return 0;
          }
          return 1;
      }

      //check if there is an exisiting invoice for a particular fee
      //method that checks if a given payment has been made
      private function checkinvoice($student_id, $fee_id) {
          $invoices_sTable = TableRegistry::get('Invoices');
          $current_session = $this->request->getSession()->read('settings');
          $payment = $invoices_sTable->find()
                          ->where(['student_id' => $student_id, 'fee_id' => $fee_id, 'session_id' => $current_session['session_id'],
                              'paystatus' => 'Unpaid'])->first();

          if (!empty($payment)) {
              return 1;
          }
          return 0;
      }

      //method that shows a student all her courses
      public function mycourses() {
          $mycourses = $this->Students->find()
                          ->where(['user_id' => $this->Auth->user('id')])
                          ->contain(['Subjects', 'Departments.Subjects'])->first();
          //  debug(json_encode( $mycourses, JSON_PRETTY_PRINT));exit;
          $this->set('mycourses', $mycourses);
          $this->viewBuilder()->setLayout('adminbackend');
      }

//method that shows the student his invoices
      public function myinvoices() {
          $student = $this->Students->find()
                          ->where(['user_id' => $this->Auth->user('id')])
                          ->contain(['Invoices.Fees', 'Invoices.Sessions', 'Fees'])->first();
          //   debug(json_encode(  $student, JSON_PRETTY_PRINT));exit;
          $this->set('student', $student);
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //method that creates invoices for students
      private function creatnewinvoice($student_id, $fee_id, $amount) {
          //  echo 'yest i got here'; exit;
          //get the invoice table
          $invoices_Table = TableRegistry::get('Invoices');
          $invoice = $invoices_Table->newEntity();
          $invoice->student_id = $student_id;
          $invoice->fee_id = $fee_id;
          $invoice->amount = $amount;
          $invoice->session_id = 1;
          $invoice->invoiceid = "NETEMS/" . $fee_id . '/' . $student_id;
          $invoices_Table->save($invoice);
          return;
      }

//method that shows a student all his invoices
      public function invoices($student_id) {
          //get the invoice table
          $invoices_Table = TableRegistry::get('Invoices');
          $myinvoices = $invoices_Table->find()
                  ->contain(['Fees', 'Sessions'])
                  ->where(['student_id' => $student_id,
                  //'paystatus'=>'Unpaid'
          ]);
          //debug(json_encode( $myinvoices, JSON_PRETTY_PRINT));exit;
          $this->set('myinvoices', $myinvoices);
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //go to paystack for payment
      public function gotopaystack($invoice_id, $student_id) {
          $transactions_Table = TableRegistry::get('Transactions');
          $invoices_Table = TableRegistry::get('Invoices');
          $invoice = $invoices_Table->get($invoice_id);
          $student = $this->Students->get($student_id);
          $name = $student->fname . ' ' . $student->lname;
          //initialize the transaction before going to paystack
          $settings = $this->request->getSession()->read('settings');

          $transaction = $transactions_Table->newEntity();
          $transaction->student_id = $student_id;
          $transaction->fee_id = $invoice->fee_id;
          $transaction->session_id = $settings['session_id'];
          $transaction->gresponse = 'initialized';
          $transaction->amount = $invoice->amount;
          $transaction->payref = uniqid('NetProEms');
          $transaction->paystatus = 'initialized';

          // debug(json_encode($transaction, JSON_PRETTY_PRINT)); exit;
          $transactions_Table->save($transaction);

          $baseurl = "http://www.netproacademy.net/";

          $subacc = 'ACCT_qyal8r4kg6pc6jc'; // sub-account code, you get this when you set up a split account.
          $cancel_url = $baseurl . 'cancel/' . $transaction->payref . '/';
          //arrange and go to paystack

          /*           * *********************************** */
          /* initialize transaction */
          /*           * ********************************** */
          $curl = curl_init();
          curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => json_encode([
                  'callback_url' => 'http://localhost/nerp/students/paymentverification/' . $transaction->payref,
                  'amount' => $invoice->amount . '00',
                  'email' => $student->email,
                  'name' => $name,
                  // 'subaccount'=> $subacc,
                  'phone' => $student->phone,
                  // 'last_name' => $lname,
                  'reference' => $transaction->payref,
                  'metadata' => json_encode([
                      'cancel_action' => $cancel_url,
                      'name' => $name,
                      // 'fname' => $fname,
                      'email' => $student->email,
                      'phone' => $student->phone,
                      'transaction_id' => $transaction->id,
                      'student_id' => $student_id,
                      'invoice_id' => $invoice->id,
                  ]),
              ]),
              CURLOPT_HTTPHEADER => [
                  "authorization: Bearer sk_test_64a330a5cc8a08c43af1d3673961f083b96ed623",
                  "content-type: application/json",
                  "cache-control: no-cache"
              ],
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);
          // debug(json_encode( $response, JSON_PRETTY_PRINT));exit;

          if ($err) {
              // there was an error contacting the Paystack API
              die('Curl returned error: ' . $err);
          }

          $tranx = json_decode($response);

          if (!$tranx->status) {
              // there was an error from the API
              die('API returned error: ' . $tranx->message);
          }
          //  header('location : '.$tranx->data->authorization_url);
          //return $tranx->data->authorization_url;
          return $this->redirect($tranx->data->authorization_url);
      }

      //verify payment and assign value
      public function paymentverification($ref) {
          // echo $ref; exit;

          $curl = curl_init();
          curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($ref),
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_HTTPHEADER => [
                  "accept: application/json",
                  "authorization: Bearer sk_test_64a330a5cc8a08c43af1d3673961f083b96ed623",
                  "cache-control: no-cache"
              ],
          ));

          //sk_test_7d5d515418c31cf203abbe3f753b1487b7d2a5e2

          $response = curl_exec($curl);
          $err = curl_error($curl);

          if ($err) {
              // there was an error contacting the Paystack API
              die('Curl returned error: ' . $err);
          }

          $tranx = json_decode($response);
          // debug( $tranx);
          if (!$tranx->status) {
              // there was an error from the API
              die('API returned error: ' . $tranx->message);
          }

          // debug($tranx); exit;
          $transactions_Table = TableRegistry::get('Transactions');
          $trans_id = $tranx->data->metadata->transaction_id;
          $email = $tranx->data->metadata->email;
          $name = $tranx->data->metadata->name;
          $invoice_id = $tranx->data->metadata->invoice_id;
          //update transaction record
          $transaction = $transactions_Table->get($trans_id);
          $transaction->status = $tranx->status;
          $transaction->amount = $tranx->data->amount / 100;
          $transaction->paystatus = 'completed';
          $transaction->gresponse = $tranx->data->status;
          $transactions_Table->save($transaction);
          // update invoice
          $invoices_Table = TableRegistry::get('Invoices');
          $invoice = $invoices_Table->get($invoice_id);
          $invoice->paystatus = $tranx->data->status;
          $invoice->payday = date('d M Y H:i a');
          $invoices_Table->save($invoice);
          //send payment alert via email
          // $this->payconfirmationmail($email,$name,$transaction->amount);

          $this->Flash->success('Your payment was successful.');
          return $this->redirect(['action' => 'invoices', $tranx->data->metadata->student_id]);
      }

      //student method for viewing their profile
      public function viewprofile() {
          $student = $this->Students->find()
                          ->where(['user_id' => $this->Auth->user('id')])
                          ->contain(['Departments.Subjects', 'States', 'Countries', 'Users', 'Subjects', 'Invoices.Fees',
                              'Invoices.Sessions', 'Results.Sessions', 'Results.Semesters', 'Results.Subjects'])->first();
          $this->set('student', $student);
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //student method for updating their profile
      public function updateprofile() {
          $student = $this->Students->find()
                          ->where(['user_id' => $this->Auth->user('id')])
                          ->contain(['Users', 'Departments', 'States', 'Countries'])->first();

          if ($this->request->is(['patch', 'post', 'put'])) {
              $userscontroller = new UsersController();
              //upload files
              //upload o level
              $imagearray = $this->request->getData('olevelresulturls');
              if (!empty($imagearray['tmp_name'])) {
                  $waec_cert = $userscontroller->addimage($imagearray);
              } else {
                  $waec_cert = $student->olevelresulturl;
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
                  $other_cert = $student->othercerts;
              }


              //upload other file
              $passport_imagearray = $this->request->getData('passporturls');
              if (!empty($passport_imagearray['tmp_name'])) {
                  $passport = $userscontroller->addimage($passport_imagearray);
              } else {
                  $passport = $student->passporturl;
              }
              $student = $this->Students->patchEntity($student, $this->request->getData());
              if (!empty($passport)) {
                  $student->passporturl = $passport;
              }
              if ($this->Students->save($student)) {
                  $this->Flash->success(__('The student data has been updated successfully.'));

                  return $this->redirect(['action' => 'viewprofile']);
              }
              $this->Flash->error(__('Profile data could not be updated. Please, try again.'));
          }
          // $departments = $this->Students->Departments->find('list', ['limit' => 200]);
          $states = $this->Students->States->find('list', ['limit' => 200]);
          $countries = $this->Students->Countries->find('list', ['limit' => 200]);
          $fees = $this->Students->Fees->find('list', ['limit' => 200]);
          $subjects = $this->Students->Subjects->find('list', ['limit' => 200]);
          $this->set(compact('student', 'states', 'countries', 'users', 'fees', 'subjects'));
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

      //admin method for bulk import of students
      public function importstudents() {

          if ($this->request->is(['patch', 'post', 'put'])) {

              $message = " ";
              $department_id = $this->request->data('department_id');

              $filename = $this->request->data['students']['name'];
              $ext = pathinfo($filename, PATHINFO_EXTENSION);
              $allowedext = ['csv', 'xlsx'];
              if ($this->request->data['students']['error']) {
                  $this->Flash->error(__('Sorry, there is a problem with the file. Please check and try again'));

                  return $this->redirect(['action' => 'importstudents']);
              }
              if (!in_array($ext, $allowedext)) {
                  $this->Flash->error(__('Sorry, only csv or xlsx files can be uploaded.'));

                  return $this->redirect(['action' => 'importstudents']);
              } else {
                  $helper = new Helper\Sample();
                  debug($helper);
                  $inputFileName = $this->request->data['students']['tmp_name'];
                  $spreadsheet = IOFactory::load($inputFileName);
                  $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                  $count = 0;
                  $old = 0;
                  $inserted = 0;
                  foreach ($sheetData as $data) {
                      $count++;

                      if ($count > 1) {
                          //debug(json_encode($data, JSON_PRETTY_PRINT)); exit;
                          $department = $this->Students->Departments->get($department_id);

                          if ((strtolower(trim($department->name)) == strtolower(trim($data['D'])))) {

                              // check if student exists in the database already.
                              $oldstudent = $this->Students->find()->where(['regno' => $data['J']])->first();
                              //  debug(json_encode($oldstudent, JSON_PRETTY_PRINT)); exit;
                              if (empty($oldstudent)) {
                                  //create login data for the student
                                  $user_id = $this->getlogindetails($data['E'], $data['A'], $data['B'], ' ');
                                  if (!is_numeric($user_id)) {
                                      $this->Flash->error(__('Sorry, there is a problem with the file. Unable to create user data. Please check and try again'));

                                      return $this->redirect(['action' => 'importstudents']);
                                  }
                                  //create a new student object
                                  $student = $this->Students->newEntity();
                                  $student->regno = $data['J'];
                                  $student->fname = $data['A'];
                                  $student->lname = $data['B'];
                                  $student->status = 'Admitted';
                                  $student->gender = $data['I'];
                                  $student->dob = $data['C'];
                                  $student->country_id = 160;
                                  $student->state_id = 2648;
                                  $student->department_id = $department_id;
                                  $student->email = $data['E'];
                                  $student->address = $data['F'];
                                  $student->phone = $data['G'];
                                  $student->admissiondate = $data['H'];
                                  $student->user_id = $user_id;
                                  //save the student
                                  $this->Students->save($student);
                                  $inserted++;
                              } else {
                                  $old++;
                                  $message = $old++ . ' Student(s) could not be uploaded because their regno already exists';
                              }
                          } else {
                              $this->Flash->error(__('Sorry, the selected department, didn\'t match that in the csv file you are uploading...'));

                              return $this->redirect(['action' => 'importstudents']);
                          }

                          // debug(json_encode($data['F'], JSON_PRETTY_PRINT)); exit;
                      }
                  }
                  $this->Flash->success(__($inserted . ' Students have been uploaded successfully. ' . $message));

                  return $this->redirect(['action' => 'importstudents']);
              }
          }

          $departments = $this->Students->Departments->find('list', ['limit' => 200])->order(['name' => 'DESC']);
          $states = $this->Students->States->find('list', ['limit' => 200]);
          $countries = $this->Students->Countries->find('list', ['limit' => 200]);

          $this->set(compact('states', 'departments', 'countries'));

          $this->viewBuilder()->setLayout('adminbackend');
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

      //method that downloads the student data format
      public function downloadformat() {
          $url = Router::url('/', true);
          $ext = pathinfo("students_format.xlsx", PATHINFO_EXTENSION);
          // echo  basename($pathtofile."cvs/students_format.xlsx"); exit;
          $filename = "students_format.xlsx";
          header('Content-Type: ' . $ext);
          header('Content-Length: ' . filesize("cvs/students_format.xlsx"));
          header('Content-Disposition: attachment;filename="' . $filename . '"');
          header("Cache-control: private");
          readfile("cvs/students_format.xlsx");
          return;
      }

      //admin method for getting students in a department
      public function getstudentsindept($deptid) {
          $students = $this->Students->find()
                  ->contain(['Departments'])
                  ->where(['department_id' => $deptid, 'status' => 'Admitted']);

          $departments = $this->Students->Departments->find('list', ['limit' => 200])->order(['name' => 'DESC']);
          $this->set('students', $students);
          $this->set('departments', $departments);
      }

      //student method for checking their application status
      public function checkstatus($application_id) {
          $applicant = $this->Students->find()->where(['application_no' => $application_id])->first();
          // debug(json_encode($applicant, JSON_PRETTY_PRINT)); exit;
          $this->set(compact('applicant'));
      }

      //admin method for sending a message to students
      public function newmessagetostudents() {

          if ($this->request->is('post')) {

              $student_ids = $this->request->getData('student._ids');
              $dept_id = $this->request->getData('department_id');
              $subject = $this->request->getData('subject');
              $message = $this->request->getData('message');
              $count = 0;
              //check if we are sending to all students in the selected department
              if (!empty($dept_id && empty($student_ids))) {
                  $students = $this->Students->find()->where(['department_id' => $dept_id]);
                  foreach ($students as $student) {
                      $greeting = 'Hello ' . $student->fname . ' ' . $student->lname . '<br />';

                      $message .= $greeting;
                      $message .= '<br /><br />';
                      $this->messagetostudents($student->email, $subject, $message);
                      $count++;
                  }
              } elseif (!empty($dept_id && !empty($student_ids))) {
                  //we are sending to selected students in a selected department
                  foreach ($student_ids as $id) {
                      $student = $this->Students->get($id);
                      $greeting = 'Hello ' . $student->fname . ' ' . $student->lname . '<br />';

                      $message .= $greeting;
                      $message .= '<br /><br />';
                      $this->messagetostudents($student->email, $subject, $message);
                      $count++;
                      // echo $id; exit;
                  }
              }
              //log activity
              $usercontroller = new UsersController();

              $title = "Sent a mail to some students ";
              $user_id = $this->Auth->user('id');
              $description = "Sent mail to a total of" . $count . " students ";
              $ip = $this->request->clientIp();
              $type = "Add";
              $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
              $this->Flash->success(__('Message has been sent to ' . $count . ' students'));
              return $this->redirect(['action' => 'newmessagetostudents']);
              //debug(json_encode( $student_ids, JSON_PRETTY_PRINT)); exit;  
          }
          $departments = $this->Students->Departments->find('list', ['limit' => 200])->order(['name' => 'DESC']);
          $students = $this->Students->find('list')->where(['status' => 'Admitted']);
          $this->set(compact('students', 'departments'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //admin method that sends a message to selected students
      private function messagetostudents($emailaddress, $subject, $message) {

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

      //student method for contacting admin
      public function contactadmin() {
          if ($this->request->is('post')) {
              $subject = $this->request->getData('subject');
              $message = $this->request->getData('message');
              //get admin email from session
              $settings = $this->request->getSession()->read('settings');
              //call the mailling function

              if ($this->messagetostudents($settings->email, $subject, $message)) {
                  // debug(json_encode($settings, JSON_PRETTY_PRINT)); exit; 
                  $this->Flash->success(__('Message has been sent to admin'));
                  return $this->redirect(['action' => 'messagetoadmin']);
              } else {
                  $this->Flash->error(__('Sorry, unable to send message, please try again'));
                  return $this->redirect(['action' => 'messagetoadmin']);
              }
          }

          $this->viewBuilder()->setLayout('adminbackend');
      }

      //students method for contacting their teacher
      public function contactlecturer() {
          $teachers_Table = TableRegistry::get('Teachers');
          $student = $this->Students->find()->where(['user_id' => $this->Auth->user('id')])->first();

          if ($this->request->is('post')) {
              $subject = $this->request->getData('subject');
              $message = $this->request->getData('message');
              $teacher_id = $this->request->getData('teacher_id');
              if (!empty($teacher_id)) {
                  $teacher = $teachers_Table->get($teacher_id, ['contain' => ['Users']]);
                  //call the mailing function
                  if ($this->messagetostudents($teacher->user->username, $subject, $message)) {
                      $this->Flash->success(__('Message has been sent to ' . $teacher->firstname . ' ' . $teacher->lastname));
                      return $this->redirect(['action' => 'contactlecturer']);
                  } else {
                      $this->Flash->error(__('Sorry, unable to send message. Please try again'));
                      return $this->redirect(['action' => 'contactlecturer']);
                  }
              }
          }
          $teachers = $teachers_Table->find('list')->where(['department_id' => $student->department_id]);
          $this->set(compact('teachers'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //method that populates the dropdown for admin to send email to students
      public function getstudentsformail($deptid) {
          $students = $this->Students->find('list')->where(['department_id' => $deptid]);
          $this->set(compact('students'));
      }

      //admin method for promoting students
      public function promotestudents() {
          $students = $this->Students->find()
                  ->contain(['Departments', 'Levels'])
                  ->where(['status' => 'Admitted'])
                  ->order(['joindate' => 'DESC']);
          if ($this->request->is('post')) {
              $level_id = $this->request->getData('slevel_id');

              $count = 0;
              // echo $level_id; exit;
              //ensure at least a student is selected
              if (!empty($this->request->getData('studentids'))) {
                  foreach ($this->request->getData('studentids') as $student_id) {
                      if (is_numeric($student_id)) {
                          $student = $this->Students->get($student_id);
                          $student->level_id = $level_id;
                          $this->Students->save($student);
                          // debug(json_encode( $this->request->getData(), JSON_PRETTY_PRINT)); exit;
                          $count++;
                          //echo "value : " . $value . '<br/>';    
                      }
                  }
                  $this->Flash->success(__($count . ' Students have been promoted to level ' . $level_id));
                  return $this->redirect(['action' => 'promotestudents']);
              } else {
                  $this->Flash->error(__(' Unable to promote student. It seems like you did not select any student after all'));
                  return $this->redirect(['action' => 'promotestudents']);
              }


              // debug(json_encode($this->request->getData('studentids'), JSON_PRETTY_PRINT)); exit;
          }
          $departments = $this->Students->Departments->find('list', ['limit' => 200])->order(['name' => 'DESC']);
          $levels = $this->Students->Levels->find('list');
          $this->set(compact('students', 'levels'));
          $this->set(compact('students', 'departments'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //admin method that gets the students to be promoted
      public function getstudentstopromote($deptid) {
          $students = $this->Students->find()
                  ->contain(['Departments', 'Levels'])
                  ->where(['department_id' => $deptid, 'status' => 'Admitted']);

          $departments = $this->Students->Departments->find('list', ['limit' => 200])->order(['name' => 'DESC']);
          $levels = $this->Students->Levels->find('list');
          $this->set(compact('students', 'levels'));
          $this->set('departments', $departments);
      }

      //student method for viewing their course materials
      public function coursematerials() {
          //ensure this is a student
          $student = $this->isstudent();
          $coursematerials_Table = TableRegistry::get('Coursematerials');
          $materials = $coursematerials_Table->find()
                  ->contain(['Teachers', 'Subjects', 'Departments'])
                  ->where(['Coursematerials.department_id' => $student->department->id]);
          $this->set('materials', $materials);
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //method that ensure this person is a student
      private function isstudent() {

          $student = $this->Students->find()
                  ->contain(['Departments', 'Subjects'])
                  ->where(['user_id' => $this->Auth->user('id')])
                  ->first();
          if (!$student) { //this is not a valid student
              $this->Flash->error(__('Sorry, invalid access'));

              return $this->redirect(['action' => 'index']);
          } else {
              return $student;
          }
      }

      //student method for dowloading course materials

      public function downloadmaterial($id) {
          //ensure this is a student
          $student = $this->isstudent();
          $coursematerials_Table = TableRegistry::get('Coursematerials');
          $coursematerial = $coursematerials_Table->get($id);
          $ext = pathinfo($coursematerial->fileurl, PATHINFO_EXTENSION);
           // debug(json_encode($coursematerial, JSON_PRETTY_PRINT)); exit;
          //  exit;
        //  if(is_file("coursematerials/" . $coursematerial->fileurl)){echo "coursematerials/" . $coursematerial->fileurl; exit;}
          header('Content-Type: ' . $ext);
          header('Content-Length: ' . filesize("coursematerials/" .$coursematerial->fileurl));
          header('Content-Disposition: attachment;filename="' . $coursematerial->fileurl . '"');
          header("Cache-control: private");
          header('Content-Transfer-Encoding', 'binary');
                header('Expires', 0);
                header('Cache-Control', 'no-cache');
                header('Pragma', 'public');
                header('X-Pad', 'avoid browser bug');

          readfile("coursematerials/" . $coursematerial->fileurl);
          return;
      }

      // allow unrestricted pages
      public function beforeFilter(Event $event) {
          $this->Auth->allow(['newapplicant', 'getstates', 'checkstatus']);
      }

  }
  