<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SubjectsTeachers Controller
 *
 * @property \App\Model\Table\SubjectsTeachersTable $SubjectsTeachers
 *
 * @method \App\Model\Entity\SubjectsTeacher[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubjectsTeachersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Teachers', 'Subjects', 'Users']
        ];
        $subjectsTeachers = $this->paginate($this->SubjectsTeachers);

        $this->set(compact('subjectsTeachers'));
    }

    /**
     * View method
     *
     * @param string|null $id Subjects Teacher id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subjectsTeacher = $this->SubjectsTeachers->get($id, [
            'contain' => ['Teachers', 'Subjects', 'Users']
        ]);

        $this->set('subjectsTeacher', $subjectsTeacher);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subjectsTeacher = $this->SubjectsTeachers->newEntity();
        if ($this->request->is('post')) {
            $subjectsTeacher = $this->SubjectsTeachers->patchEntity($subjectsTeacher, $this->request->getData());
            if ($this->SubjectsTeachers->save($subjectsTeacher)) {
                $this->Flash->success(__('The subjects teacher has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subjects teacher could not be saved. Please, try again.'));
        }
        $teachers = $this->SubjectsTeachers->Teachers->find('list', ['limit' => 200]);
        $subjects = $this->SubjectsTeachers->Subjects->find('list', ['limit' => 200]);
        $users = $this->SubjectsTeachers->Users->find('list', ['limit' => 200]);
        $this->set(compact('subjectsTeacher', 'teachers', 'subjects', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Subjects Teacher id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subjectsTeacher = $this->SubjectsTeachers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subjectsTeacher = $this->SubjectsTeachers->patchEntity($subjectsTeacher, $this->request->getData());
            if ($this->SubjectsTeachers->save($subjectsTeacher)) {
                $this->Flash->success(__('The subjects teacher has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subjects teacher could not be saved. Please, try again.'));
        }
        $teachers = $this->SubjectsTeachers->Teachers->find('list', ['limit' => 200]);
        $subjects = $this->SubjectsTeachers->Subjects->find('list', ['limit' => 200]);
        $users = $this->SubjectsTeachers->Users->find('list', ['limit' => 200]);
        $this->set(compact('subjectsTeacher', 'teachers', 'subjects', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Subjects Teacher id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subjectsTeacher = $this->SubjectsTeachers->get($id);
        if ($this->SubjectsTeachers->delete($subjectsTeacher)) {
            $this->Flash->success(__('The subjects teacher has been deleted.'));
        } else {
            $this->Flash->error(__('The subjects teacher could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
