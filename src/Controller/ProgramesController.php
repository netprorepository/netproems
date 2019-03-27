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
    public function index()
    {
        $this->paginate = [
            'contain' => ['Departments']
        ];
        $programes = $this->paginate($this->Programes);

        $this->set(compact('programes'));
    }

    /**
     * View method
     *
     * @param string|null $id Programe id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $programe = $this->Programes->get($id, [
            'contain' => ['Departments']
        ]);

        $this->set('programe', $programe);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $programe = $this->Programes->newEntity();
        if ($this->request->is('post')) {
            $programe = $this->Programes->patchEntity($programe, $this->request->getData());
            if ($this->Programes->save($programe)) {
                $this->Flash->success(__('The programe has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The programe could not be saved. Please, try again.'));
        }
        $departments = $this->Programes->Departments->find('list', ['limit' => 200]);
        $this->set(compact('programe', 'departments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Programe id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $programe = $this->Programes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $programe = $this->Programes->patchEntity($programe, $this->request->getData());
            if ($this->Programes->save($programe)) {
                $this->Flash->success(__('The programe has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The programe could not be saved. Please, try again.'));
        }
        $departments = $this->Programes->Departments->find('list', ['limit' => 200]);
        $this->set(compact('programe', 'departments'));
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
            $this->Flash->success(__('The programe has been deleted.'));
        } else {
            $this->Flash->error(__('The programe could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
