<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Programes Controller
 *
 * @property \App\Model\Table\ProgramesTable $Programes
 *
 * @method \App\Model\Entity\Programe[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProgramesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function manageprogrames()
    {
        $this->paginate = [
            'contain' => ['Departments']
        ];
        $programes = $this->paginate($this->Programes);

        $this->set(compact('programes'));
        $this->viewBuilder()->setLayout('adminbackend');
    }

    /**
     * View method
     *
     * @param string|null $id Programe id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewprogrames($id = null)
    {
        $programe = $this->Programes->get($id, [
            'contain' => ['Departments','Departments.Faculties']
        ]);

        $this->set('programe', $programe);
         $this->viewBuilder()->setLayout('adminbackend');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function newprograme()
    {
        $programe = $this->Programes->newEntity();
        if ($this->request->is('post')) {
            $programe = $this->Programes->patchEntity($programe, $this->request->getData());
            if ($this->Programes->save($programe)) {
                 //log activity
                $usercontroller = new UsersController();
               
                 $title = "Added a new programe ".$programe->id;
                $user_id = $this->Auth->user('id');
                $description = "Created new programe " . $programe->name;
                $ip = $this->request->clientIp();
                $type = "Add";
                $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
                $this->Flash->success(__('The programe has been saved.'));

                return $this->redirect(['action' => 'manageprogrames']);
            }
            $this->Flash->error(__('The programe could not be saved. Please, try again.'));
        }
        $departments = $this->Programes->Departments->find('list', ['limit' => 200])->order(['name'=>'ASC']);
        $this->set(compact('programe', 'departments'));
          $this->viewBuilder()->setLayout('adminbackend');
    }

    /**
     * Edit method
     *
     * @param string|null $id Programe id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function updateprograme($id = null)
    {
        $programe = $this->Programes->get($id, [
            'contain' => ['Departments']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $programe = $this->Programes->patchEntity($programe, $this->request->getData());
            if ($this->Programes->save($programe)) {
                 //log activity
                $usercontroller = new UsersController();
               
                 $title = "Updated a programe ".$programe->id;
                $user_id = $this->Auth->user('id');
                $description = "Updated a programme " . $programe->name;
                $ip = $this->request->clientIp();
                $type = "Edit";
                $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
                $this->Flash->success(__('The programe has been updated.'));

                return $this->redirect(['action' => 'manageprogrames']);
            }
            $this->Flash->error(__('The programe could not be saved. Please, try again.'));
        }
        $departments = $this->Programes->Departments->find('list', ['limit' => 200])->order(['name'=>'ASC']);
        $this->set(compact('programe', 'departments'));
         $this->viewBuilder()->setLayout('adminbackend');
    }

    /**
     * Delete method
     *
     * @param string|null $id Programe id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $programe = $this->Programes->get($id);
        if ($this->Programes->delete($programe)) {
             //log activity
                $usercontroller = new UsersController();
               
                 $title = "Deleted a programe ".$programe->id;
                $user_id = $this->Auth->user('id');
                $description = "Deleted a programme " . $programe->name;
                $ip = $this->request->clientIp();
                $type = "Delete";
                $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
            $this->Flash->success(__('The programe has been deleted.'));
        } else {
            $this->Flash->error(__('The programe could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'manageprogrames']);
    }
}
