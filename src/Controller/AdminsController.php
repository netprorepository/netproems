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
 * Admins Controller
 *
 * @property \App\Model\Table\AdminsTable $Admins
 *
 * @method \App\Model\Entity\Admin[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdminsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Departments']
        ];
        $admins = $this->paginate($this->Admins);

        $this->set(compact('admins'));
        $this->viewBuilder()->setLayout('adminbackend');
    }

    
    //admin method for managing transcript requests
    public function managetranscriptorders(){
        //ensure this is an admin
        $this->isadmin();
        $trequest_table = TableRegistry::get('Trequests');
        $trequests = $trequest_table->find()
                ->contain(['Students','Countries','Continents','States','Couriers'])
               // ->where(['Invoice.status'=>'success'])
                ->order(['orderdate'=>'DESC']);
        
        $this->set('trequests',$trequests);
        $this->viewBuilder()->setLayout('adminbackend');
    }

    
    
    //admin method for generating transcripts
    public function generatetranscript($student_id){
        //ensure this is an admin
        $this->isadmin();
         $stdents_table = TableRegistry::get('Students');
          $student = $stdents_table->get($student_id, [
              'contain' => ['Departments.Subjects', 'Users','Results.Sessions', 'Results.Semesters','Trequests',
                  'Results.Subjects']
          ]);
          $this->set('student', $student);
          debug(json_encode( $student->results, JSON_PRETTY_PRINT)); exit;
      
        $this->viewBuilder()->setLayout('adminbackend');
    }


//method that ensures this person is an admin
      private function isadmin(){
          $admin = $this->Admins->find()->where(['user_id'=>$this->Auth->user('id')]);
          if(!$admin){
              $this->Flash->error(__('Sorry, unknown admin account'));
                      return $this->redirect(['controller'=>'Students','action' => 'index']);
          }
          else{
              return $admin;
          }
      }

            /**
     * View method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $admin = $this->Admins->get($id, [
            'contain' => ['Users', 'Departments']
        ]);

        $this->set('admin', $admin);
        $this->viewBuilder()->setLayout('adminbackend');
    }
    
    
     public function newadmin()
    {
        $admin = $this->Admins->newEntity();
        if ($this->request->is('post')) {
             $email = $this->request->getData('username');
              $fname = $this->request->getData('surname');
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
                
            $admin = $this->Admins->patchEntity($admin, $this->request->getData());
            $admin->user_id = $user_id;
            $admin->adminphoto = $image_name;
            $admin->status = "active";
            if ($this->Admins->save($admin)) {
                //log activity
                  $usercontroller = new UsersController();

                  $title = "added a new admin " . $admin->surname;
                  $user_id = $this->Auth->user('id');
                  $description = "Created new admin " . $admin->lastname;
                  $ip = $this->request->clientIp();
                  $type = "Add";
                  $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
                $this->Flash->success(__('The admin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin could not be saved. Please, try again.'));
        }
        }
      $departments = $this->Admins->Departments->find('list', ['limit' => 200]);
        $this->set(compact('admin', 'users', 'departments'));
        $this->viewBuilder()->setLayout('adminbackend');
    }

    
    
            //method that creates login details for the new admin
      private function getlogindetails($email, $fname, $lname, $mname) {
          $users_Table = TableRegistry::get('Users');
          $user = $users_Table->newEntity();
          $user->role_id = 1;
          $user->password = "admin123";
          $user->username = $email;
          $user->fname = $fname;
          $user->lname = $lname;
          $user->mname = $mname;
          if ($users_Table->save($user)) {
              return $user->id;
          } else {
              return "Failed";
          }
          return;
      }
    
    
    
    

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $admin = $this->Admins->newEntity();
        if ($this->request->is('post')) {
            $admin = $this->Admins->patchEntity($admin, $this->request->getData());
            if ($this->Admins->save($admin)) {
                $this->Flash->success(__('The admin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin could not be saved. Please, try again.'));
        }
        $users = $this->Admins->Users->find('list', ['limit' => 200]);
        $departments = $this->Admins->Departments->find('list', ['limit' => 200]);
        $this->set(compact('admin', 'users', 'departments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $admin = $this->Admins->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $admin = $this->Admins->patchEntity($admin, $this->request->getData());
            if ($this->Admins->save($admin)) {
                $this->Flash->success(__('The admin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin could not be saved. Please, try again.'));
        }
        $users = $this->Admins->Users->find('list', ['limit' => 200]);
        $departments = $this->Admins->Departments->find('list', ['limit' => 200]);
        $this->set(compact('admin', 'users', 'departments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $admin = $this->Admins->get($id);
        if ($this->Admins->delete($admin)) {
            $this->Flash->success(__('The admin has been deleted.'));
        } else {
            $this->Flash->error(__('The admin could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
