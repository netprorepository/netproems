<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Sparents Controller
 *
 * @property \App\Model\Table\SparentsTable $Sparents
 *
 * @method \App\Model\Entity\Sparent[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SparentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $sparents = $this->paginate($this->Sparents);

        $this->set(compact('sparents'));
    }

    /**
     * View method
     *
     * @param string|null $id Sparent id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sparent = $this->Sparents->get($id, [
            'contain' => ['Students']
        ]);

        $this->set('sparent', $sparent);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sparent = $this->Sparents->newEntity();
        if ($this->request->is('post')) {
            $sparent = $this->Sparents->patchEntity($sparent, $this->request->getData());
            if ($this->Sparents->save($sparent)) {
                $this->Flash->success(__('The sparent has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sparent could not be saved. Please, try again.'));
        }
        $students = $this->Sparents->Students->find('list', ['limit' => 200]);
        $this->set(compact('sparent', 'students'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sparent id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sparent = $this->Sparents->get($id, [
            'contain' => ['Students']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sparent = $this->Sparents->patchEntity($sparent, $this->request->getData());
            if ($this->Sparents->save($sparent)) {
                $this->Flash->success(__('The sparent has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sparent could not be saved. Please, try again.'));
        }
        $students = $this->Sparents->Students->find('list', ['limit' => 200]);
        $this->set(compact('sparent', 'students'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sparent id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sparent = $this->Sparents->get($id);
        if ($this->Sparents->delete($sparent)) {
            $this->Flash->success(__('The sparent has been deleted.'));
        } else {
            $this->Flash->error(__('The sparent could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
