<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Departments Controller
 *
 * @property \App\Model\Table\DepartmentsTable $Departments
 *
 * @method \App\Model\Entity\Department[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DepartmentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function managedepartments()
    {
        $this->paginate = [
            'contain' => ['Faculties']
        ];
        $departments = $this->paginate($this->Departments);

        $this->set(compact('departments'));
         $this->viewBuilder()->setLayout('adminbackend');
    }

    /**
     * View method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewdepartment($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => ['Faculties', 'Programes','Fees']
        ]);

        $this->set('department', $department);
         $this->viewBuilder()->setLayout('adminbackend');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function newdepartment()
    {
        $department = $this->Departments->newEntity();
        if ($this->request->is('post')) {
            $department = $this->Departments->patchEntity($department, $this->request->getData());
            if ($this->Departments->save($department)) {
                 //log activity
                $usercontroller = new UsersController();
               
                 $title = "Updated a department ".$department->id;
                $user_id = $this->Auth->user('id');
                $description = "Created new department " . $department->name;
                $ip = $this->request->clientIp();
                $type = "Add";
                $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
                $this->Flash->success(__('The department has been added successfully.'));

                return $this->redirect(['action' => 'managedepartments']);
            }
            $this->Flash->error(__('The department could not be saved. Please, try again.'));
        }
        $faculties = $this->Departments->Faculties->find('list', ['limit' => 200])->order(['name'=>'ASC']);
        $this->set(compact('department', 'faculties'));
         $this->viewBuilder()->setLayout('adminbackend');
    }

    /**
     * Edit method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function updatedepartment($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => ['Faculties']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $department = $this->Departments->patchEntity($department, $this->request->getData());
            if ($this->Departments->save($department)) {
                //log activity
                $usercontroller = new UsersController();
               
                 $title = "Updated a department ".$id;
                $user_id = $this->Auth->user('id');
                $description = "Updated a department " . $department->name;
                $ip = $this->request->clientIp();
                $type = "Edit";
                $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
              
                $this->Flash->success(__('The department has been updated.'));

                return $this->redirect(['action' => 'managedepartments']);
            }
            $this->Flash->error(__('The department could not be updated. Please, try again.'));
        }
        $faculties = $this->Departments->Faculties->find('list', ['limit' => 200])->order(['name'=>'ASC']);
        $this->set(compact('department', 'faculties'));
        $this->viewBuilder()->setLayout('adminbackend');
    }

    /**
     * Delete method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $department = $this->Departments->get($id);
        if ($this->Departments->delete($department)) {
           //log activity
                $usercontroller = new UsersController();
               
                 $title = "Deleted a department ".$id;
                $user_id = $this->Auth->user('id');
                $description = "Deleted a department " . $department->name;
                $ip = $this->request->clientIp();
                $type = "Delete";
                $usercontroller->makeLog($title, $user_id, $description, $ip, $type); 
            $this->Flash->success(__('The department has been deleted.'));
        } else {
            $this->Flash->error(__('The department could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'managedepartments']);
    }
}
