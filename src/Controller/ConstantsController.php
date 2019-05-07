<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Constants Controller
 *
 * @property \App\Model\Table\ConstantsTable $Constants
 *
 * @method \App\Model\Entity\Constant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConstantsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $constants = $this->paginate($this->Constants);

        $this->set(compact('constants'));
    }

    /**
     * View method
     *
     * @param string|null $id Constant id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $constant = $this->Constants->get($id, [
            'contain' => []
        ]);

        $this->set('constant', $constant);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $constant = $this->Constants->newEntity();
        if ($this->request->is('post')) {
            $constant = $this->Constants->patchEntity($constant, $this->request->getData());
            if ($this->Constants->save($constant)) {
                $this->Flash->success(__('The constant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The constant could not be saved. Please, try again.'));
        }
        $this->set(compact('constant'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Constant id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $constant = $this->Constants->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $constant = $this->Constants->patchEntity($constant, $this->request->getData());
            if ($this->Constants->save($constant)) {
                $this->Flash->success(__('The constant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The constant could not be saved. Please, try again.'));
        }
        $this->set(compact('constant'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Constant id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $constant = $this->Constants->get($id);
        if ($this->Constants->delete($constant)) {
            $this->Flash->success(__('The constant has been deleted.'));
        } else {
            $this->Flash->error(__('The constant could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
