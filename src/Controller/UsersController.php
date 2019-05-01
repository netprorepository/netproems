<?php

namespace App\Controller;
 use Cake\Routing\Router;
use Cake\Event\Event;
 use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {

    public function login() {
        //get the logo on the login page
         $settings_Table = TableRegistry::get('Settings');
        $logo = $settings_Table->get(1);
        if ($this->request->is('post')) {
            //   debug(json_encode($this->request->getData(), JSON_PRETTY_PRINT)); exit;
            $user = $this->Auth->identify();

            if ($user && $user['userstatus'] != 'Disabled') {
                $this->Auth->setUser($user);
                $RolesTable = TableRegistry::get('Roles');
                $roles = $RolesTable->get($user['role_id']);
                $this->updateLogout($user['id']);
                $this->createLogin($user['id']);
                //get the system settings and put it in session
                $settings = $settings_Table->get(1);
                $this->request->getSession()->write('settings', $settings);
                // debug(json_encode($settings, JSON_PRETTY_PRINT)); exit;

                $this->request->getSession()->write('usersinfo', $user);
                $this->request->getSession()->write('usersroles', $roles);
                if($user['role_id']==2){
                    //get the student and put it in session
                    $studentsTable = TableRegistry::get('Students');
                    $student =  $studentsTable->find()->where(['user_id'=>$user['id']])->first();
                     $this->request->getSession()->write('student', $student);
                   return $this->redirect(['controller' => 'Students', 'action' => 'dashboard']); 
                }
                elseif($user['role_id']==3){
                    //get the teacher or employee details and put them in session
                      $teachersTable = TableRegistry::get('Teachers');
                    $teacher =  $teachersTable->find()->where(['user_id'=>$user['id']])->first();
                     $this->request->getSession()->write('teacher', $teacher);
                   return $this->redirect(['controller' => 'Teachers', 'action' => 'dashboard']);
                }
                else{
                return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
                }
            } else {
                $this->Flash->error('Bad Credentials or account disabled. Please check your credentials or contact admin for assistance');
            }
        }
        $this->set('logo', $logo);
        $this->viewBuilder()->setLayout('login');
    }

    //the user dashboard
    public function dashboard() {
        $admin = $this->Users->get($this->Auth->user('id'));
         $students_Table = TableRegistry::get('Students');
         $teachers_Table = TableRegistry::get('Teachers');
         $subjects_Table = TableRegistry::get('Subjects');
         $subjects = $subjects_Table->find()->count();
         $teachers = $teachers_Table->find()->count();
         $students = $students_Table->find()->where(['status'=>'Admitted'])->count();
          $pending_students = $students_Table->find()->where(['status'=>'Selected'])->count();
        $this->set('admin', $admin);
        $this->set(compact('pending_students','students','teachers','subjects'));
        $this->viewBuilder()->setLayout('adminbackend');
    }

    //admin method for managing admins
    public function manageadmins() {
        //ensure admin is loggeding
        $this->isloggedin();

        $admins = $this->Users->find()->where(['role_id'=>1])
                ->contain(['Roles']);


        $this->set('admins', $admins);

        $this->viewBuilder()->setLayout('adminbackend');
    }

//ensure admin is loggedin
    public function isloggedin() {
        $admin = $this->Users->get($this->Auth->user('id'));
        if ($admin) {
            $this->set('admin', $admin);
            $this->request->getSession()->write('admin', $admin);
        } else {
            $this->Flash->error('Please login to continue');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
        return;
    }

    //the log otu function
    public function logout($user_id) {
        $UserLoginTable1 = TableRegistry::get('Userlogins');
        $userLogin = $UserLoginTable1->find()
                ->where(['logouttime' => '0000-00-00 00:00:00', 'user_id' => $user_id])
                ->first();
        if ($userLogin) {
            $userLogin->logouttime = date('Y-m-d H:i:s');
            $UserLoginTable1->save($userLogin);
            //debug(json_encode( $userLogin, JSON_PRETTY_PRINT)); exit;
            $this->request->getSession()->destroy();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        } else {
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    public function updateLogout($user_id) {
        $UserLoginTable1 = TableRegistry::get('Userlogins');
        $userLogin = $UserLoginTable1->find()
                ->where(['logouttime' => '0000-00-00 00:00:00', 'user_id' => $user_id])
                ->first();
        if ($userLogin) {
            $userLogin->logouttime = date('Y-m-d H:i:s');
            $UserLoginTable1->save($userLogin);
            //debug(json_encode( $userLogin, JSON_PRETTY_PRINT)); exit;
        } else {
            return;
        }
    }

    public function createLogin($user_id) {
        $UserLoginTable = TableRegistry::get('Userlogins');
        $newUserLogin0 = $UserLoginTable->newEntity();
        $newUserLogin0->user_id = $user_id;
        $UserLoginTable->save($newUserLogin0);
        return;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        //ensure admin is loggeding
        $this->isloggedin();
        $this->paginate = [
            'contain' => ['Roles', 'Countries', 'States', 'Departments']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->viewBuilder()->setLayout('adminbackend');
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $user = $this->Users->get($id, [
            'contain' => ['Roles', 'Countries', 'States', 'Departments', 'Logs']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function newadmin() {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {

            //upload passport
           /* $imagearray = $this->request->getData('passports');
            if (!empty($imagearray['tmp_name'])) {
                $image_name = $this->addimage($imagearray);
            } else {
                $image_name = '';
            }*/

            $user = $this->Users->patchEntity($user, $this->request->getData());
           // $user->passport = $image_name;
            $user->created_by = $this->Auth->user('id');
            //  debug(json_encode( $user, JSON_PRETTY_PRINT)); exit;
            if ($this->Users->save($user)) {
                //generate uniqu id
                $this->createadminid($user->id);
                $this->Flash->success(__('The admin has been saved.'));

                return $this->redirect(['action' => 'manageadmins']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        /*$countries = $this->Users->Countries->find('list', ['limit' => 200]);
        $states = $this->Users->States->find('list', ['limit' => 200]);*/
        $departments = $this->Users->Departments->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles', 'departments'));
        $this->viewBuilder()->setLayout('adminbackend');
    }

    //function that generates a unique ID for each
    private function createadminid($id) {
        //get invoice prefix from session
        $settings = $this->request->getSession()->read('settings');
        $user = $this->Users->get($id);
        $user->useruniquid = $settings['adminprefix'] . date('y/m') . '/' . $id;
        $this->Users->save($user);
        return;
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function updateadmin($id = null) {
        //ensure admin is loggeding
        $this->isloggedin();
        $user = $this->Users->get($id, [
            'contain' => ['Roles', 'Departments']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //upload passport
            $imagearray = $this->request->getData('passport');
            if (!empty($imagearray['tmp_name'])) {
                $image_name = $this->addimage($imagearray);
            } else {
                $image_name = $user->passport;
            }

            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->passport = $image_name;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The admin has been supdated successfuly.'));

                return $this->redirect(['action' => 'manageadmins']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $countries = $this->Users->Countries->find('list', ['limit' => 200]);
        $states = $this->Users->States->find('list', ['limit' => 200]);
        $departments = $this->Users->Departments->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles', 'countries', 'states', 'departments'));
        $this->viewBuilder()->setLayout('adminbackend');
    }

    //function for adding a staff image
    public function addimage($imagearray) {
        $folder_upload = "img/";
        $extension = array("jpeg", "jpg", "png", "gif");
        if (empty($imagearray['tmp_name'])) {
            return;
        }
        //$message = " ";
        $size = \getimagesize($imagearray['tmp_name']);
        // $mimetype = stripslashes($size['mime']); 
        if ((empty($size) || ($size[0] === 0) || ($size[1] === 0))) {
            throw new \Exception('This is unacceptable!. image must be of type : gif, jpeg, png or jpg and less than 2mb.');
        }
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
//     //$filename = "company_staff_ids/".$staff_id;
        $file_type = $finfo->file(h($imagearray['tmp_name']), FILEINFO_MIME_TYPE);
//    
//    echo $file_type; exit;
        if (!(($file_type == "image/gif") || ($file_type == "image/png") || ($file_type == "image/jpeg") ||
                ($file_type == "image/pjpeg") || ($file_type == "image/x-png"))) {
            throw new \Exception('This is unacceptable!. image must be of type : gif, jpeg, png or jpg and less than 2mb .');
        }

        $file_name = $imagearray['name'];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);

        if (in_array($ext, $extension)) {
            $file_name = md5(uniqid($imagearray['name'], true)) . time();

            if (!file_exists($folder_upload . $file_name . '.' . $ext)) {
                $file_name = $file_name . '.' . $ext;
                move_uploaded_file($imagearray["tmp_name"], $folder_upload . $file_name);

                chmod($folder_upload . $file_name, 0644);
                return $message = $file_name;
            } else {
                $filename = basename($file_name, $ext);
                $newFileName = crypt($filename . time()) . "." . $ext;
                // echo $file_name; exit;
                move_uploaded_file($imagearray["tmp_name"], $folder_upload . $newFileName);
                chmod($folder_upload . $newFileName, 0644);
                //delete old file
                unlink($folder_upload . $file_name);
                return $message = $newFileName;
            }
        } else {
            return $message = 'Unable to upload image, please ensure you are uploading a jpg,png,gif or Jpeg file. ';
            // debug(json_encode( $error, JSON_PRETTY_PRINT)); exit;
        }


        return $message = "images upload successful";
    }

    //functionn for deleting a file
    public function deletefile($filename) {
        $folder_upload = "img/";
        if (file_exists($folder_upload . $filename)) {
            unlink($folder_upload . $filename);
            return;
        }
        return;
    }

    //method that keeps track of all user activities on the app

    public function makeLog($title, $user_id, $description, $ip, $type) {
        $LogsTable = TableRegistry::get('Logs');
        $logs = $LogsTable->newEntity();
        $logs->title = $title;
        $logs->user_id = $user_id;
        $logs->description = $description;
        $logs->ip = $ip;
        $logs->type = $type;
        // debug(json_encode( $logs, JSON_PRETTY_PRINT)); exit;
        $LogsTable->save($logs);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    
  


//forgot password method
      public function forgotpassword(){
           if ($this->request->is('post')) {
               $username =  $this->request->getData('username');
               $user = $this->Users->find()->where(['username'=>$username])->first();
               if($user){
                   //send a mail with the verification link
                   $user->verification_key = md5($username);
                   $this->Users->save($user);
                   if($this->emailverification($username, $user->verification_key)){
                       $this->Flash->success(__('A verification mail has been sent to you. Please check your inbox/spam folder and click on the link'));
                   }else{
                       $this->Flash->error(__('Sorry, unable to send mail. Please try again'));
                   }
                  return $this->redirect(['controller' => 'Users', 'action' => 'forgotpassword']); 
               }
               $this->Flash->success(__('Sorry, user not found'));
               return $this->redirect(['controller' => 'Users', 'action' => 'forgotpassword']);
               
           }
          
           $this->viewBuilder()->setLayout('login');
      }


      // allow unrestricted pages
    public function beforeFilter(Event $event) {
         $this->Auth->allow(['forgotpassword','emailverification','changepaasword','changepassword']);
        if (!$this->Auth->user()) {
            $this->Auth->setConfig('authError', false);
        }
    }

    public function changeuserstatus($user_id, $status) {
        $user = $this->Users->get($user_id);
        $user->userstatus = $status;
        if ($this->Users->save($user)) {
            $this->Flash->success(__('Admin status has been changed to ' . $status));
        } else {
            $this->Flash->error(__('Unable to change admin status. Please, try again.'));
        }
        return $this->redirect(['controller' => 'Users', 'action' => 'manageadmins']);
    }

    public function viewadmin($user_id) {


        $admin = $this->Users->get($user_id, [
            'contain' => ['Roles', 'Departments', 'Countries', 'States']
        ]);
        $this->set('admin', $admin);
        $this->viewBuilder()->setLayout('adminbackend');
    }
    
    
    
    //admin method for viewing her profile
    public function myprofile(){
         $admin = $this->Users->get($this->Auth->user('id'), [
            'contain' => ['Roles', 'Departments', 'Countries', 'States']
        ]);
        $this->set('admin', $admin);
        
        $this->viewBuilder()->setLayout('adminbackend');
        
    }
    
    
    
     //method for uploading cvs
      public function uploadcv($file, $folder) {
          $extension = ['.docx', '.doc', '.pdf', '.txt'];
        //  $finfo = new \finfo(FILEINFO_MIME_TYPE);

          // $file_type = $finfo->file(h($file['tmp_name']), FILEINFO_MIME_TYPE);
          // $ext = pathinfo($file_type, PATHINFO_EXTENSION);
          $ext = strrchr($file['name'], '.');
          // echo $ext; exit;
          if (in_array($ext, $extension)) {
              $file_name = md5(uniqid($file['name'], true)) . time();

              if (!file_exists($folder . $file_name . $ext)) {
                  $file_name = $file_name . $ext;

                  move_uploaded_file($file["tmp_name"], $folder . $file_name);

                  chmod($folder . $file_name, 0644);
                  return $message = $file_name;
              } else {
                  $filename = basename($file_name, $ext);
                  $newFileName = crypt($filename . time()) . "." . $ext;
                  // echo $file_name; exit;
                  move_uploaded_file($file["tmp_name"], $folder . $newFileName);
                  chmod($folder . $newFileName, 0644);
                  return $message = $newFileName;
              }
          } else {
              return $message = 'Unable to upload image, please ensure you are uploading a jpg,png,gif or Jpeg file. ';
              // debug(json_encode( $error, JSON_PRETTY_PRINT)); exit;
          }


          // return $message = "images upload successful";
//          if (!(($file_type == ".doc") || ($file_type == ".docx") || ($file_type == ".pdf") ||
//                  ($file_type == ".txt"))) {
//              throw new \Exception('This is unacceptable!. image must be of type : gif, jpeg, png or jpg and less than 2mb .');
//          }
      }
    
    
    //method that send an email verification link
    public function emailverification($username,$key){
         //base url
          $baseUrl = Router::url('/', true);
         $message = "Hello, you have requested to reset your password, please click the below link to reset your password<br />.";

        $message .= $baseUrl."users/changepassword/".$key;

          $message .= '<br /><br />'
                  . 'Kind Regards,<br />'
                  . 'NetPro AEMS. <br />';


          // $statusmsg = "";
          $email = new Email('default');
          $email->setFrom(['no-reply@netproacademy.com' => 'NetPro Int\'l Ltd']);
          $email->setTo($username);
          $email->setBcc(['chukwudi@netpro.com.ng']);
          $email->setEmailFormat('html');
          $email->setSubject('Password Reset');
          $email->send($message);
          return;
    }
    
    
    //method that changes the password ead2c29088db4ffe4b7069146716157a
    public function changepassword($key){
          if ($this->request->is('post')) {
              
        $user = $this->Users->find()->where(['verification_key'=>$key])->first();
        if($user){
          $user->password = $this->request->getData('password');
        if ($this->Users->save($user)) {
            $this->Flash->success(__('Your password has been updated'));
        } else {
            $this->Flash->error(__('Unable to change password. Please, try again.'));
        }
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
        
          }
           $this->viewBuilder()->setLayout('login');
    }
}
