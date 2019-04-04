<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Fees Controller
 *
 * @property \App\Model\Table\FeesTable $Fees
 *
 * @method \App\Model\Entity\Fee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function managefees()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $fees = $this->paginate($this->Fees);

        $this->set(compact('fees'));
        $this->viewBuilder()->setLayout('adminbackend');
    }

    /**
     * View method
     *
     * @param string|null $id Fee id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewfee($id = null)
    {
        $fee = $this->Fees->get($id, [
            'contain' => ['Users', 'Feeallocations']
        ]);

        $this->set('fee', $fee);
        $this->viewBuilder()->setLayout('adminbackend');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function newfee()
    {
        $fee = $this->Fees->newEntity();
        if ($this->request->is('post')) {
            $fee = $this->Fees->patchEntity($fee, $this->request->getData());
            $fee->user_id = $this->Auth->user('id');
            if ($this->Fees->save($fee)) {
                 //log activity
                $usercontroller = new UsersController();
               
                 $title = "Added a new Fee ".$fee->name;
                $user_id = $this->Auth->user('id');
                $description = "Created a new Fee " . $fee->name;
                $ip = $this->request->clientIp();
                $type = "Add";
                $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
                $this->Flash->success(__('The fee has been saved.'));

                return $this->redirect(['action' => 'managefees']);
            }
            $this->Flash->error(__('The fee could not be saved. Please, try again.'));
        }
        $users = $this->Fees->Users->find('list', ['limit' => 200]);
        $this->set(compact('fee', 'users'));
        $this->viewBuilder()->setLayout('adminbackend');
    }

    /**
     * Edit method
     *
     * @param string|null $id Fee id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editfee($id = null)
    {
        $fee = $this->Fees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fee = $this->Fees->patchEntity($fee, $this->request->getData());
            if ($this->Fees->save($fee)) {
                //log activity
                $usercontroller = new UsersController();
               
                 $title = "Updated a fee ".$fee->name;
                $user_id = $this->Auth->user('id');
                $description = "Updated a Fee " . $fee->name;
                $ip = $this->request->clientIp();
                $type = "Edit";
                $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
                $this->Flash->success(__('The fee has been updated.'));

                return $this->redirect(['action' => 'managefees']);
            }
            $this->Flash->error(__('The fee could not be saved. Please, try again.'));
        }
        $users = $this->Fees->Users->find('list', ['limit' => 200]);
        $this->set(compact('fee', 'users'));
        $this->viewBuilder()->setLayout('adminbackend');
    }

    
    
    //admin method for deactivating a fee
    public function deactivatefee($id=null){
     $fee = $this->Fees->get($id); 
     $fee->status = 0;
     if($this->Fees->save($fee)){
         $this->Flash->success(__('The fee has been Deactivated.'));

                return $this->redirect(['action' => 'managefees']);
     }
     else{
       $this->Flash->success(__('Sorry, unable to deactivate fee. Please try again.'));

                return $this->redirect(['action' => 'managefees']);  
     }
        
    }

    
    //admin method for activating a fee
    public function activatefee($id=null){
     $fee = $this->Fees->get($id); 
     $fee->status = 1;
     if($this->Fees->save($fee)){
         $this->Flash->success(__('The fee has been activated.'));

                return $this->redirect(['action' => 'managefees']);
     }
     else{
       $this->Flash->success(__('Sorry, unable to activate fee. Please try again.'));

                return $this->redirect(['action' => 'managefees']);  
     }
        
    }
    

    /**
     * Delete method
     *
     * @param string|null $id Fee id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fee = $this->Fees->get($id);
        if ($this->Fees->delete($fee)) {
            $this->Flash->success(__('The fee has been deleted.'));
        } else {
            $this->Flash->error(__('The fee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'managefees']);
        
    }
}
