<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 *
 * @method \App\Model\Entity\Student[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function managestudents()
    {
        $this->paginate = [
            'contain' => ['Departments', 'States', 'Countries', 'Users']
        ];
        $students = $this->paginate($this->Students);

        $this->set(compact('students'));
         $this->viewBuilder()->setLayout('adminbackend');
    }

    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $student = $this->Students->get($id, [
            'contain' => ['Departments', 'States', 'Countries', 'Users', 'Fees', 'Subjects']
        ]);

        $this->set('student', $student);
         $this->viewBuilder()->setLayout('adminbackend');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function newstudent()
    {
        $student = $this->Students->newEntity();
        if ($this->request->is('post')) {
            $student = $this->Students->patchEntity($student, $this->request->getData());
            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));

                return $this->redirect(['action' => 'managestudents']);
            }
            $this->Flash->error(__('The student could not be saved. Please, try again.'));
        }
        $departments = $this->Students->Departments->find('list', ['limit' => 200]);
        $states = $this->Students->States->find('list', ['limit' => 200]);
        $countries = $this->Students->Countries->find('list', ['limit' => 200]);
        $users = $this->Students->Users->find('list', ['limit' => 200]);
        $fees = $this->Students->Fees->find('list', ['limit' => 200]);
        $subjects = $this->Students->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('student', 'departments', 'states', 'countries', 'users', 'fees', 'subjects'));
         $this->viewBuilder()->setLayout('adminbackend');
    }

    /**
     * Edit method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $student = $this->Students->get($id, [
            'contain' => ['Fees', 'Subjects']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $student = $this->Students->patchEntity($student, $this->request->getData());
            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));

                return $this->redirect(['action' => 'managestudents']);
            }
            $this->Flash->error(__('The student could not be saved. Please, try again.'));
        }
        $departments = $this->Students->Departments->find('list', ['limit' => 200]);
        $states = $this->Students->States->find('list', ['limit' => 200]);
        $countries = $this->Students->Countries->find('list', ['limit' => 200]);
        $users = $this->Students->Users->find('list', ['limit' => 200]);
        $fees = $this->Students->Fees->find('list', ['limit' => 200]);
        $subjects = $this->Students->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('student', 'departments', 'states', 'countries', 'users', 'fees', 'subjects'));
         $this->viewBuilder()->setLayout('adminbackend');
    }

    /**
     * Delete method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $student = $this->Students->get($id);
        if ($this->Students->delete($student)) {
            $this->Flash->success(__('The student has been deleted.'));
        } else {
            $this->Flash->error(__('The student could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'managestudents']);
    }
}
