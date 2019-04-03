<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Subjects Controller
 *
 * @property \App\Model\Table\SubjectsTable $Subjects
 *
 * @method \App\Model\Entity\Subject[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubjectsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Departments', 'Users']
        ];
        $subjects = $this->paginate($this->Subjects);

        $this->set(compact('subjects'));
    }

    /**
     * View method
     *
     * @param string|null $id Subject id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subject = $this->Subjects->get($id, [
            'contain' => ['Departments', 'Users', 'SubjectTeachers']
        ]);

        $this->set('subject', $subject);
        $this->viewBuilder()->setLayout('adminbackend');   
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subject = $this->Subjects->newEntity();
        if ($this->request->is('post')) {
            $subject = $this->Subjects->patchEntity($subject, $this->request->getData());
            if ($this->Subjects->save($subject)) {
                $this->Flash->success(__('The subject has been saved.'));

                return $this->redirect(['action' => 'managesubjects']);
            }
            $this->Flash->error(__('The subject could not be saved. Please, try again.'));
        }
        $departments = $this->Subjects->Departments->find('list', ['limit' => 200]);
        $users = $this->Subjects->Users->find('list', ['limit' => 200]);
        $this->set(compact('subject', 'departments', 'users'));
         $this->viewBuilder()->setLayout('adminbackend');
    }
        
        
    
    

    /**
     * Edit method
     *
     * @param string|null $id Subject id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subject = $this->Subjects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subject = $this->Subjects->patchEntity($subject, $this->request->getData());
            if ($this->Subjects->save($subject)) {
                $this->Flash->success(__('The subject has been saved.'));

                return $this->redirect(['action' => 'managesubjects']);
            }
            $this->Flash->error(__('The subject could not be saved. Please, try again.'));
        }
        $departments = $this->Subjects->Departments->find('list', ['limit' => 200]);
        $users = $this->Subjects->Users->find('list', ['limit' => 200]);
        $this->set(compact('subject', 'departments', 'users'));

        $this->viewBuilder()->setLayout('adminbackend');   
    }

    /**
     * Delete method
     *
     * @param string|null $id Subject id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subject = $this->Subjects->get($id);
        if ($this->Subjects->delete($subject)) {
            $this->Flash->success(__('The subject has been deleted.'));
        } else {
            $this->Flash->error(__('The subject could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function managesubjects()
    {
        $this->paginate = [
            'contain' => ['Departments', 'Users']
        ];
        $subjects = $this->paginate($this->Subjects);

        $this->set(compact('subjects'));

        $this->viewBuilder()->setLayout('adminbackend');    
        
    }
    
     public function changesubjectstatus($id, $status) {
        $subjects = $this->Subjects->get($id);
        $subjects->status = $status;
        if ($status==1){$mystatus="Enabled";}
        else if ($status==0){$mystatus="Disabled";}
        
        if ($this->Subjects->save($subjects)) {
            $this->Flash->success(__('Subject status ' . $mystatus));
        } else {
            $this->Flash->error(__('Unable to change Subjects status. Please, try again.'));
        }
        return $this->redirect(['controller' => 'Subjects', 'action' => 'managesubjects']);
    }
}
