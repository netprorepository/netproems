<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Trequests Controller
 *
 * @property \App\Model\Table\TrequestsTable $Trequests
 *
 * @method \App\Model\Entity\Trequest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TrequestsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Students', 'Continents', 'Countries', 'States', 'Couriers']
        ];
        $trequests = $this->paginate($this->Trequests);

        $this->set(compact('trequests'));
    }

    /**
     * View method
     *
     * @param string|null $id Trequest id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $trequest = $this->Trequests->get($id, [
            'contain' => ['Students', 'Continents', 'Countries', 'States', 'Couriers']
        ]);

        $this->set('trequest', $trequest);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $trequest = $this->Trequests->newEntity();
        if ($this->request->is('post')) {
            $trequest = $this->Trequests->patchEntity($trequest, $this->request->getData());
            if ($this->Trequests->save($trequest)) {
                $this->Flash->success(__('The trequest has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The trequest could not be saved. Please, try again.'));
        }
        $students = $this->Trequests->Students->find('list', ['limit' => 200]);
        $continents = $this->Trequests->Continents->find('list', ['limit' => 200]);
        $countries = $this->Trequests->Countries->find('list', ['limit' => 200]);
        $states = $this->Trequests->States->find('list', ['limit' => 200]);
        $couriers = $this->Trequests->Couriers->find('list', ['limit' => 200]);
        $this->set(compact('trequest', 'students', 'continents', 'countries', 'states', 'couriers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Trequest id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $trequest = $this->Trequests->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $trequest = $this->Trequests->patchEntity($trequest, $this->request->getData());
            if ($this->Trequests->save($trequest)) {
                $this->Flash->success(__('The trequest has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The trequest could not be saved. Please, try again.'));
        }
        $students = $this->Trequests->Students->find('list', ['limit' => 200]);
        $continents = $this->Trequests->Continents->find('list', ['limit' => 200]);
        $countries = $this->Trequests->Countries->find('list', ['limit' => 200]);
        $states = $this->Trequests->States->find('list', ['limit' => 200]);
        $couriers = $this->Trequests->Couriers->find('list', ['limit' => 200]);
        $this->set(compact('trequest', 'students', 'continents', 'countries', 'states', 'couriers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Trequest id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $trequest = $this->Trequests->get($id);
        if ($this->Trequests->delete($trequest)) {
            $this->Flash->success(__('The trequest has been deleted.'));
        } else {
            $this->Flash->error(__('The trequest could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
