<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SubjectTeachers Controller
 *
 * @property \App\Model\Table\SubjectTeachersTable $SubjectTeachers
 *
 * @method \App\Model\Entity\SubjectTeacher[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubjectTeachersController extends AppController
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
        $subjectTeachers = $this->paginate($this->SubjectTeachers);

        $this->set(compact('subjectTeachers'));
    }

    /**
     * View method
     *
     * @param string|null $id Subject Teacher id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subjectTeacher = $this->SubjectTeachers->get($id, [
            'contain' => ['Teachers', 'Subjects', 'Users']
        ]);

        $this->set('subjectTeacher', $subjectTeacher);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subjectTeacher = $this->SubjectTeachers->newEntity();
        if ($this->request->is('post')) {
            $subjectTeacher = $this->SubjectTeachers->patchEntity($subjectTeacher, $this->request->getData());
            if ($this->SubjectTeachers->save($subjectTeacher)) {
                $this->Flash->success(__('The subject teacher has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subject teacher could not be saved. Please, try again.'));
        }
        $teachers = $this->SubjectTeachers->Teachers->find('list', ['limit' => 200]);
        $subjects = $this->SubjectTeachers->Subjects->find('list', ['limit' => 200]);
        $users = $this->SubjectTeachers->Users->find('list', ['limit' => 200]);
        $this->set(compact('subjectTeacher', 'teachers', 'subjects', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Subject Teacher id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subjectTeacher = $this->SubjectTeachers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subjectTeacher = $this->SubjectTeachers->patchEntity($subjectTeacher, $this->request->getData());
            if ($this->SubjectTeachers->save($subjectTeacher)) {
                $this->Flash->success(__('The subject teacher has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subject teacher could not be saved. Please, try again.'));
        }
        $teachers = $this->SubjectTeachers->Teachers->find('list', ['limit' => 200]);
        $subjects = $this->SubjectTeachers->Subjects->find('list', ['limit' => 200]);
        $users = $this->SubjectTeachers->Users->find('list', ['limit' => 200]);
        $this->set(compact('subjectTeacher', 'teachers', 'subjects', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Subject Teacher id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subjectTeacher = $this->SubjectTeachers->get($id);
        if ($this->SubjectTeachers->delete($subjectTeacher)) {
            $this->Flash->success(__('The subject teacher has been deleted.'));
        } else {
            $this->Flash->error(__('The subject teacher could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
