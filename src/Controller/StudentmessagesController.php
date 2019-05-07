<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Studentmessages Controller
 *
 * @property \App\Model\Table\StudentmessagesTable $Studentmessages
 *
 * @method \App\Model\Entity\Studentmessage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudentmessagesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Students', 'Users']
        ];
        $studentmessages = $this->paginate($this->Studentmessages);

        $this->set(compact('studentmessages'));
    }

    /**
     * View method
     *
     * @param string|null $id Studentmessage id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $studentmessage = $this->Studentmessages->get($id, [
            'contain' => ['Students', 'Users']
        ]);

        $this->set('studentmessage', $studentmessage);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $studentmessage = $this->Studentmessages->newEntity();
        if ($this->request->is('post')) {
            $studentmessage = $this->Studentmessages->patchEntity($studentmessage, $this->request->getData());
            if ($this->Studentmessages->save($studentmessage)) {
                $this->Flash->success(__('The studentmessage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The studentmessage could not be saved. Please, try again.'));
        }
        $students = $this->Studentmessages->Students->find('list', ['limit' => 200]);
        $users = $this->Studentmessages->Users->find('list', ['limit' => 200]);
        $this->set(compact('studentmessage', 'students', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Studentmessage id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $studentmessage = $this->Studentmessages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studentmessage = $this->Studentmessages->patchEntity($studentmessage, $this->request->getData());
            if ($this->Studentmessages->save($studentmessage)) {
                $this->Flash->success(__('The studentmessage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The studentmessage could not be saved. Please, try again.'));
        }
        $students = $this->Studentmessages->Students->find('list', ['limit' => 200]);
        $users = $this->Studentmessages->Users->find('list', ['limit' => 200]);
        $this->set(compact('studentmessage', 'students', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Studentmessage id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $studentmessage = $this->Studentmessages->get($id);
        if ($this->Studentmessages->delete($studentmessage)) {
            $this->Flash->success(__('The studentmessage has been deleted.'));
        } else {
            $this->Flash->error(__('The studentmessage could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
