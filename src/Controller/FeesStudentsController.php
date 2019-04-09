<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FeesStudents Controller
 *
 * @property \App\Model\Table\FeesStudentsTable $FeesStudents
 *
 * @method \App\Model\Entity\FeesStudent[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeesStudentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Fees', 'Students']
        ];
        $feesStudents = $this->paginate($this->FeesStudents);

        $this->set(compact('feesStudents'));
    }

    /**
     * View method
     *
     * @param string|null $id Fees Student id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feesStudent = $this->FeesStudents->get($id, [
            'contain' => ['Fees', 'Students']
        ]);

        $this->set('feesStudent', $feesStudent);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feesStudent = $this->FeesStudents->newEntity();
        if ($this->request->is('post')) {
            $feesStudent = $this->FeesStudents->patchEntity($feesStudent, $this->request->getData());
            if ($this->FeesStudents->save($feesStudent)) {
                $this->Flash->success(__('The fees student has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fees student could not be saved. Please, try again.'));
        }
        $fees = $this->FeesStudents->Fees->find('list', ['limit' => 200]);
        $students = $this->FeesStudents->Students->find('list', ['limit' => 200]);
        $this->set(compact('feesStudent', 'fees', 'students'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fees Student id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feesStudent = $this->FeesStudents->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feesStudent = $this->FeesStudents->patchEntity($feesStudent, $this->request->getData());
            if ($this->FeesStudents->save($feesStudent)) {
                $this->Flash->success(__('The fees student has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fees student could not be saved. Please, try again.'));
        }
        $fees = $this->FeesStudents->Fees->find('list', ['limit' => 200]);
        $students = $this->FeesStudents->Students->find('list', ['limit' => 200]);
        $this->set(compact('feesStudent', 'fees', 'students'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fees Student id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feesStudent = $this->FeesStudents->get($id);
        if ($this->FeesStudents->delete($feesStudent)) {
            $this->Flash->success(__('The fees student has been deleted.'));
        } else {
            $this->Flash->error(__('The fees student could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
