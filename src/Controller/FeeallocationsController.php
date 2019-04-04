<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Feeallocations Controller
 *
 * @property \App\Model\Table\FeeallocationsTable $Feeallocations
 *
 * @method \App\Model\Entity\Feeallocation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeeallocationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Fees', 'Departments', 'Users']
        ];
        $feeallocations = $this->paginate($this->Feeallocations);

        $this->set(compact('feeallocations'));
    }

    /**
     * View method
     *
     * @param string|null $id Feeallocation id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feeallocation = $this->Feeallocations->get($id, [
            'contain' => ['Fees', 'Departments', 'Users']
        ]);

        $this->set('feeallocation', $feeallocation);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feeallocation = $this->Feeallocations->newEntity();
        if ($this->request->is('post')) {
            $feeallocation = $this->Feeallocations->patchEntity($feeallocation, $this->request->getData());
            if ($this->Feeallocations->save($feeallocation)) {
                $this->Flash->success(__('The feeallocation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeallocation could not be saved. Please, try again.'));
        }
        $fees = $this->Feeallocations->Fees->find('list', ['limit' => 200]);
        $departments = $this->Feeallocations->Departments->find('list', ['limit' => 200]);
        $users = $this->Feeallocations->Users->find('list', ['limit' => 200]);
        $this->set(compact('feeallocation', 'fees', 'departments', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Feeallocation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feeallocation = $this->Feeallocations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feeallocation = $this->Feeallocations->patchEntity($feeallocation, $this->request->getData());
            if ($this->Feeallocations->save($feeallocation)) {
                $this->Flash->success(__('The feeallocation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeallocation could not be saved. Please, try again.'));
        }
        $fees = $this->Feeallocations->Fees->find('list', ['limit' => 200]);
        $departments = $this->Feeallocations->Departments->find('list', ['limit' => 200]);
        $users = $this->Feeallocations->Users->find('list', ['limit' => 200]);
        $this->set(compact('feeallocation', 'fees', 'departments', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Feeallocation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feeallocation = $this->Feeallocations->get($id);
        if ($this->Feeallocations->delete($feeallocation)) {
            $this->Flash->success(__('The feeallocation has been deleted.'));
        } else {
            $this->Flash->error(__('The feeallocation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
