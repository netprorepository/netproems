<?php

  namespace App\Controller;

  use Cake\ORM\TableRegistry;
  use Cake\Mailer\Email;
  use Cake\Event\Event;
  use Cake\Routing\Router;
  use App\Controller\AppController;

  /**
   * Transactions Controller
   *
   * @property \App\Model\Table\TransactionsTable $Transactions
   *
   * @method \App\Model\Entity\Transaction[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
   */
  class TransactionsController extends AppController {

      //go to paystack for payment
      public function gotopaystack($mail, $phone, $name, $amount, $student_id,$fee_id) {
          //initialize the transaction before going to paystack
           $settings = $this->request->getSession()->read('settings');
       //  echo $student_id; exit;
          $transaction = $this->Transactions->newEntity();
          $transaction->student_id = $student_id;
          $transaction->fee_id = $fee_id;
          $transaction->gresponse = 'initialized';
          $transaction->amount = $amount;
          $transaction->session_id = $settings->session_id;
          $transaction->payref = uniqid('NetProEms');
          $transaction->paystatus = 'initialized';

          // debug(json_encode($transaction, JSON_PRETTY_PRINT)); exit;
          $this->Transactions->save($transaction);
          //base url
          $baseUrl = Router::url('/', true);
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
                  'callback_url' => $baseUrl . 'transactions/paymentverification/' . $transaction->payref,
                  'amount' => $amount . '00',
                  'email' => $mail,
                  'name' => $name,
                  // 'subaccount'=> $subacc,
                  'phone' => $phone,
                  // 'last_name' => $lname,
                  'reference' => $transaction->payref,
                  'metadata' => json_encode([
                      'cancel_action' => $cancel_url,
                      'name' => $name,
                      // 'fname' => $fname,
                      'email' => $mail,
                      'phone' => $phone,
                      'transaction_id' => $transaction->id,
                      'student_id' => $student_id,
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

          // store transaction reference so we can query in case user never comes back
          // perhaps due to network issue
          //save_last_transaction_reference($tranx->data->reference);
          // $transaction = $this->Transactions->get($trans_id);
          //$transaction->tnxref = $tranx->data->reference;
          //$this->Transactions->save($transaction);
          // redirect to page so User can pay
          // debug($tranx); exit; 
          // return $this->redirect($tranx->data->authorization_url);
          return $tranx->data->authorization_url;
          //return $this->redirect($tranx->data->authorization_url);
          // header('Location: ' . $tranx->data->authorization_url);
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
          $trans_id = $tranx->data->metadata->transaction_id;
          $email = $tranx->data->metadata->email;
          $name = $tranx->data->metadata->name;
          //update transaction record
          $transaction = $this->Transactions->get($trans_id);
          $transaction->status = $tranx->status;
          $transaction->amount = $tranx->data->amount / 100;
          $transaction->paystatus = 'completed';
          $transaction->gresponse = $tranx->data->status;
          $this->Transactions->save($transaction);
          //send payment alert via email
           $this->applicationconfirmationmail($email,$name,$transaction->amount,$transaction->student_id);

          $this->Flash->success('Your application is complete. We will get back to you shortly ');

          $this->set('transaction', $transaction);
          $this->viewBuilder()->setLayout('login');
      }

      //methodthat sends a mail to the student confirming his payment 
      public function applicationconfirmationmail($emailaddress, $name, $amount,$student_id) {
          $students_table = TableRegistry::get('Students');
          $student = $students_table->get($student_id,['contain'=>['Departments']]);

          $message = " Hello " . $name . ' ' . ',<br />Our school has recieved your application. We will review and revert back to you soon '
                  . '<br /><br /> .'
                  . ' Do remember that you can always use your application number to check your admission status any time. <br />Please find details below your payment details: <br />';

          $message .= '<br />Course : '.$student->department->name;
          // $message .= '<br /> Duration : ' . $course->duration;
          $message .= '<br /> Application  Date : ' . date('D, d M Y');
           $message .= '<br /> Application  Number : ' .$student->application_no;
          // $message .= '<br /> Amount Paid : ' . $course->end_date;
          $message .= '<br /> Cost : ₦' . number_format($amount);

          $message .= '<br /><br />'
                  . 'Kind Regards,<br />'
                  . 'NetPro AEMS. <br />';


          // $statusmsg = "";
          $email = new Email('default');
          $email->setFrom(['no-reply@yulo.ng' => 'NetPro Int\'l Ltd']);
          $email->setTo($emailaddress);
          $email->setBcc(['chukwudi@netpro.com.ng']);
          $email->setEmailFormat('html');
          $email->setSubject('Application Payment Receipt');
          $email->send($message);
          return;
      }

      /**
       * Index method
       *
       * @return \Cake\Http\Response|void
       */
      public function index() {
          //search for transactions
          if ($this->request->is('post')) {
              $from = date('Y-m-d', strtotime(date($this->request->data('startdate'))));

              $to = date('Y-m-d', strtotime(date($this->request->data('enddate'))));
              $transactions = $this->Transactions->find()
                      ->contain(['Students', 'Fees', 'Sessions'])
                      ->where(['DATE(transdate) >= ' => $from])
                      ->andwhere(['paystatus'=>'completed'])
                      ->andWhere(['DATE(transdate) <= ' => $to])
                      ->order(['transdate' => 'DESC']);


//             $transactions = $this->Transactions->find()
//                     ->contain(['Students','Fees','Sessions'])
//             ->where(function (QueryExpression $exp, Query $q) {
//                return $exp->between('DATE(transdate)', $from, $to)
//                        ->order(['transdate'=>'DESC']);
//    });
          } else {
              $transactions = $this->Transactions->find()
                      ->contain(['Students', 'Fees', 'Sessions'])
                      ->where(['paystatus'=>'completed'])
                      ->order(['transdate' => 'DESC']);
              //get the base url
          }
          $baseUrl = Router::url('/', true);

          $this->set(compact('transactions', 'baseUrl'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      /**
       * View method
       *
       * @param string|null $id Transaction id.
       * @return \Cake\Http\Response|void
       * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
       */
      public function view($id = null) {
          $transaction = $this->Transactions->get($id, [
              'contain' => ['Students']
          ]);

          $this->set('transaction', $transaction);
      }

      /**
       * Add method
       *
       * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
       */
      public function add() {
          $transaction = $this->Transactions->newEntity();
          if ($this->request->is('post')) {
              $transaction = $this->Transactions->patchEntity($transaction, $this->request->getData());
              if ($this->Transactions->save($transaction)) {
                  $this->Flash->success(__('The transaction has been saved.'));

                  return $this->redirect(['action' => 'index']);
              }
              $this->Flash->error(__('The transaction could not be saved. Please, try again.'));
          }
          $students = $this->Transactions->Students->find('list', ['limit' => 200]);
          $this->set(compact('transaction', 'students'));
      }

      /**
       * Edit method
       *
       * @param string|null $id Transaction id.
       * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
       * @throws \Cake\Network\Exception\NotFoundException When record not found.
       */
      public function edit($id = null) {
          $transaction = $this->Transactions->get($id, [
              'contain' => []
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
              $transaction = $this->Transactions->patchEntity($transaction, $this->request->getData());
              if ($this->Transactions->save($transaction)) {
                  $this->Flash->success(__('The transaction has been saved.'));

                  return $this->redirect(['action' => 'index']);
              }
              $this->Flash->error(__('The transaction could not be saved. Please, try again.'));
          }
          $students = $this->Transactions->Students->find('list', ['limit' => 200]);
          $this->set(compact('transaction', 'students'));
      }

      /**
       * Delete method
       *
       * @param string|null $id Transaction id.
       * @return \Cake\Http\Response|null Redirects to index.
       * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
       */
      public function delete($id = null) {
          $this->request->allowMethod(['post', 'delete']);
          $transaction = $this->Transactions->get($id);
          if ($this->Transactions->delete($transaction)) {
              $this->Flash->success(__('The transaction has been deleted.'));
          } else {
              $this->Flash->error(__('The transaction could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'index']);
      }

      // allow unrestricted pages
      public function beforeFilter(Event $event) {
          $this->Auth->allow(['paymentverification', 'confirmationmail']);
      }

  }
  