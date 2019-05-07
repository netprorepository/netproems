<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Couriers Controller
 *
 * @property \App\Model\Table\CouriersTable $Couriers
 *
 * @method \App\Model\Entity\Courier[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CouriersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $couriers = $this->paginate($this->Couriers);

        $this->set(compact('couriers'));
    }

    /**
     * View method
     *
     * @param string|null $id Courier id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $courier = $this->Couriers->get($id, [
            'contain' => ['Trequests']
        ]);

        $this->set('courier', $courier);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $courier = $this->Couriers->newEntity();
        if ($this->request->is('post')) {
            $courier = $this->Couriers->patchEntity($courier, $this->request->getData());
            if ($this->Couriers->save($courier)) {
                $this->Flash->success(__('The courier has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The courier could not be saved. Please, try again.'));
        }
        $this->set(compact('courier'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Courier id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $courier = $this->Couriers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $courier = $this->Couriers->patchEntity($courier, $this->request->getData());
            if ($this->Couriers->save($courier)) {
                $this->Flash->success(__('The courier has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The courier could not be saved. Please, try again.'));
        }
        $this->set(compact('courier'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Courier id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $courier = $this->Couriers->get($id);
        if ($this->Couriers->delete($courier)) {
            $this->Flash->success(__('The courier has been deleted.'));
        } else {
            $this->Flash->error(__('The courier could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
