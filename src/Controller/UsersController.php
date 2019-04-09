<?php

namespace App\Controller;

use Cake\Event\Event;
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
                return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
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

        $this->set('admin', $admin);
        $this->viewBuilder()->setLayout('adminbackend');
    }

    //admin method for managing admins
    public function manageadmins() {
        //ensure admin is loggeding
        $this->isloggedin();

        $admins = $this->Users->find()->contain(['Roles']);


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

    // allow unrestricted pages
    public function beforeFilter(Event $event) {
        // $this->Auth->allow(['add']);
        if (!$this->Auth->user()) {
            $this->Auth->config('authError', false);
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
    
    

}
