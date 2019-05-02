<?php

  namespace App\Controller;

  use Cake\Routing\Router;
  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\IOFactory;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
  use PhpOffice\PhpSpreadsheet\Helper;
  use App\Controller\AppController;

  /**
   * Results Controller
   *
   * @property \App\Model\Table\ResultsTable $Results
   *
   * @method \App\Model\Entity\Result[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
   */
  class ResultsController extends AppController {

      /**
       * Index method
       *
       * @return \Cake\Http\Response|void
       */
      public function manageresults() {
          //if this was a search
          if ($this->request->is('post')) {
              $department_id = $this->request->data('department_id');
              // $program_id = $this->request->data('program_id');
              $session_id = $this->request->data('session_id');
              $semester_id = $this->request->data('semester_id');
              $course_id = $this->request->data('subject_id');
              $student_id = $this->request->data('student_id');
              $conditions = [];
              if (!empty($department_id)) {
                  $conditions['Results.department_id'] = $department_id;
                  // $conditions = [
                  //  'subject_id' => $course_id,
                  //  'student_id' => $student_id,
                  // 'department_id' => $department_id,
                  //  'session_id' => $session_id,
                  // 'semester_id' => $semester_id
                  //  ];    
              }
              if (!empty($course_id)) {
                  $conditions['Results.subject_id'] = $course_id;
              }
              if (!empty($student_id)) {
                  $conditions['Results.student_id'] = $student_id;
              }
              if (!empty($session_id)) {
                  $conditions['Results.session_id'] = $session_id;
              }
              if (!empty($semester_id)) {
                  $conditions['Results.semester_id'] = $semester_id;
              }

              $results = $this->Results->find()
                      ->contain(['Students', 'Faculties', 'Departments', 'Subjects', 'Semesters', 'Sessions','Users'])
                      ->where($conditions);
              //debug(json_encode($conditions, JSON_PRETTY_PRINT)); exit;
              $this->set('results', $this->paginate($results));
          } else { //if this was not a search
              $this->paginate = [
                  'contain' => ['Students', 'Faculties', 'Departments', 'Subjects', 'Semesters', 'Sessions', 'Users']
              ];

              $results = $this->paginate($this->Results);

              $this->set(compact('results'));
          }
          $faculties = $this->Results->Faculties->find('list', ['limit' => 200])
                  ->order(['name' => 'ASC']);
          $departments = $this->Results->Departments->find('list', ['limit' => 200])
                  ->order(['name' => 'ASC']);
          $subjects = $this->Results->Subjects->find('list', ['limit' => 200])
                  ->order(['name' => 'ASC']);
          $semesters = $this->Results->Semesters->find('list', ['limit' => 200]);
          $sessions = $this->Results->Sessions->find('list', ['limit' => 200]);
          $students = $this->Results->Students->find('list', ['limit' => 2000]);
          $this->set(compact('results', 'students', 'faculties', 'departments', 'subjects', 'semesters', 'sessions', 'users'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      /**
       * View method
       *
       * @param string|null $id Result id.
       * @return \Cake\Http\Response|void
       * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
       */
      public function view($id = null) {
          $result = $this->Results->get($id, [
              'contain' => ['Students', 'Faculties', 'Departments', 'Subjects', 'Semesters', 'Sessions', 'Users']
          ]);

          $this->set('result', $result);
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //admin and teacher method for result bulk upload
      public function uploadresults() {

          if ($this->request->is(['patch', 'post', 'put'])) {
              $faculty_id = $this->request->data('faculty_id');
              $department_id = $this->request->data('department_id');
              // $program_id = $this->request->data('program_id');
              $session_id = $this->request->data('session_id');
              $semester_id = $this->request->data('semester_id');
              $course_id = $this->request->data('subject_id');


              $filename = $this->request->data['result']['name'];
              $ext = pathinfo($filename, PATHINFO_EXTENSION);
              // echo $ext; exit;
              $allowedext = ['csv', 'xlsx'];
              if ($this->request->data['result']['error']) {
                  $this->Flash->error(__('Sorry, there is a problem with the file,only csv or xlsx files can be uploaded. Please check and try again'));

                  return $this->redirect(['action' => 'uploadresults']);
              }
              if (!in_array($ext, $allowedext)) {
                  $this->Flash->error(__('Sorry, only csv or xlsx files can be uploaded.'));

                  return $this->redirect(['action' => 'uploadresults']);
              } else {
                  $helper = new Helper\Sample();
                  debug($helper);
                  $inputFileName = $this->request->data['result']['tmp_name'];
                  $spreadsheet = IOFactory::load($inputFileName);
                  $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                  $count = 0;
                  $inserted = 0;
                  $duplicate_results = 0;
                  $unknown_students = 0;
                  foreach ($sheetData as $data) {

                      $count++;

                      if ($count > 1) {
                          // debug(json_encode( $data, JSON_PRETTY_PRINT)); exit;
                          //  $programe = $programes_table->get($program_id);
                          $department = $this->Results->Departments->get($department_id);
                          $semester = $this->Results->Semesters->get($semester_id);
                          $course = $this->Results->Subjects->get($course_id);
                          $session = $this->Results->Sessions->get($session_id);

//               echo strtolower(trim($semester->name)) .' '. strtolower(trim($data['H'])).'<br />';
//              echo strtolower(trim($department->name)) .' '. strtolower(trim($data['G'])).'<br />';
//             echo  strtolower(trim($programe->programname)) .' '. strtolower(trim($data['F'])).'<br />';
//             echo  strtolower(trim($course->name)) .' '. strtolower(trim($data['F'])).'<br />';
//            echo   strtolower(trim($session->name)) .' '. strtolower(trim($data['I'])).'<br />';
//            exit;
                          if (strtolower(trim($department->name)) === strtolower(trim($data['G'])) &&
                                  strtolower(trim($course->name)) === strtolower(trim($data['F'])) &&
                                  strtolower(trim($semester->name)) === strtolower(trim($data['H'])) &&
                                  strtolower(trim($session->name)) === strtolower(trim($data['I']))) {

                              //get the student and ensure no double result
                              //  debug(json_encode( $data, JSON_PRETTY_PRINT)); exit;
                              $student = $this->Results->Students->find()->where(['regno' => $data['A']])->first();
                              //ensure no result for this course already

                              if ($student) {

                                  $has_result = $this->Results->find()->where(['regno' => $data['A'],
                                      'department_id' => $department_id, 'subject_id' => $course_id, 'semester_id' => $semester_id, 'session_id' => $session_id]);
                                  if (empty($has_result->toArray())) {
                                      // debug(json_encode( $data, JSON_PRETTY_PRINT)); exit;
                                      //create a new result for this student
                                      $result = $this->Results->newEntity();
                                      $result->regno = $data['A'];
                                      // $result->surname = $data['B'];
                                      $result->student_id = $student->id;
                                      $result->faculty_id = $faculty_id;
                                      // $result->firstname = $data['C'];
                                      // $result->middlename = $data['D'];
                                      $result->department_id = $department_id;
                                      $result->remark = $data['E'];
                                      $result->semester_id = $semester_id;
                                      $result->subject_id = $course_id;
                                      $result->session_id = $session_id;
                                      $result->creditload = $data['D'];
                                      $result->score = $data['B'];
                                      $result->grade = $data['C'];
                                      $result->user_id = $this->Auth->user('id');
                                      // debug(json_encode($result, JSON_PRETTY_PRINT)); exit;
                                      $this->Results->save($result);
                                      $inserted ++;
                                  } else {
                                      $duplicate_results++;
                                  }
                              } else {
                                  $unknown_students++;
                              }
                          } else {
                              $this->Flash->error('Total results uploaded : ' . $inserted . ' Some results failed to upload because selected data didnt match provided data. Please ensure the right department,'
                                      . 'course, session and faculty was selected. Duplicate results found : ' . $duplicate_results
                                      . ' Unknown students : ' . $unknown_students);
                              return $this->redirect(['action' => 'uploadresults']);
                          }

                          // debug(json_encode($data['F'], JSON_PRETTY_PRINT)); exit;
                      }
                  }
                  //log activity
                  $usercontroller = new UsersController();

                  $title = "Result Bulk Upload ";
                  $user_id = $this->Auth->user('id');
                  $description = "Uploaded " . $inserted . ' results';
                  $ip = $this->request->clientIp();
                  $type = "Add";
                  $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
                  $this->Flash->success(__($inserted . ' Result(s) have been uploaded successfully. Duplicates found : ' . $duplicate_results . ' Unknown students : ' . $unknown_students));

                  return $this->redirect(['action' => 'uploadresults']);
              }
          }

          $faculties = $this->Results->Faculties->find('list', ['limit' => 200])
                  ->order(['name' => 'ASC']);
          $departments = $this->Results->Departments->find('list', ['limit' => 200])
                  ->order(['name' => 'ASC']);
          $subjects = $this->Results->Subjects->find('list', ['limit' => 200])
                  ->order(['name' => 'ASC']);
          $semesters = $this->Results->Semesters->find('list', ['limit' => 200]);
          $sessions = $this->Results->Sessions->find('list', ['limit' => 200]);
          $this->viewBuilder()->setLayout('adminbackend');
          $this->set(compact('result', 'students', 'faculties', 'departments', 'subjects', 'semesters', 'sessions', 'users'));
      }

      //method that downloads the result file format 
      public function downloadformat() {
          // $url = Router::url('/', true);
          $ext = pathinfo("result_sample.xlsx", PATHINFO_EXTENSION);
          // echo  basename($pathtofile."cvs/students_format.xlsx"); exit;
          $filename = "result_sample.xlsx";
          header('Content-Type: ' . $ext);
          header('Content-Length: ' . filesize("cvs/result_sample.xlsx"));
          header('Content-Disposition: attachment;filename="' . $filename . '"');
          header("Cache-control: private");
          readfile("cvs/result_sample.xlsx");
          return;
      }

      /**
       * Add method
       *
       * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
       */
      public function add() {
          $result = $this->Results->newEntity();
          if ($this->request->is('post')) {
              $result = $this->Results->patchEntity($result, $this->request->getData());
              if ($this->Results->save($result)) {
                  $this->Flash->success(__('The result has been saved.'));

                  return $this->redirect(['action' => 'manageresults']);
              }
              $this->Flash->error(__('The result could not be saved. Please, try again.'));
          }
          $students = $this->Results->Students->find('list', ['limit' => 200]);
          $faculties = $this->Results->Faculties->find('list', ['limit' => 200]);
          $departments = $this->Results->Departments->find('list', ['limit' => 200]);
          $subjects = $this->Results->Subjects->find('list', ['limit' => 200]);
          $semesters = $this->Results->Semesters->find('list', ['limit' => 200]);
          $sessions = $this->Results->Sessions->find('list', ['limit' => 200]);
          $users = $this->Results->Users->find('list', ['limit' => 200]);
          $this->set(compact('result', 'students', 'faculties', 'departments', 'subjects', 'semesters', 'sessions', 'users'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      /**
       * Edit method
       *
       * @param string|null $id Result id.
       * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
       * @throws \Cake\Network\Exception\NotFoundException When record not found.
       */
      public function updateresult($id = null) {
          $result = $this->Results->get($id, [
              'contain' => ['Students', 'Faculties', 'Departments', 'Subjects', 'Semesters', 'Sessions']
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
              $result = $this->Results->patchEntity($result, $this->request->getData());
              if ($this->Results->save($result)) {
                  //log activity
                  $usercontroller = new UsersController();

                  $title = "Updated a Result ";
                  $user_id = $this->Auth->user('id');
                  $description = "Updated a result " . $result->id;
                  $ip = $this->request->clientIp();
                  $type = "Update";
                  $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
                  $this->Flash->success(__('The result has been updated.'));

                  return $this->redirect(['action' => 'manageresults']);
              }
              $this->Flash->error(__('The result could not be saved. Please, try again.'));
          }
          $students = $this->Results->Students->find('list', ['limit' => 200]);
          $faculties = $this->Results->Faculties->find('list', ['limit' => 200]);
          $departments = $this->Results->Departments->find('list', ['limit' => 200]);
          $subjects = $this->Results->Subjects->find('list', ['limit' => 200]);
          $semesters = $this->Results->Semesters->find('list', ['limit' => 200]);
          $sessions = $this->Results->Sessions->find('list', ['limit' => 200]);
          $users = $this->Results->Users->find('list', ['limit' => 200]);
          $this->set(compact('result', 'students', 'faculties', 'departments', 'subjects', 'semesters', 'sessions', 'users'));
          $this->viewBuilder()->setLayout('adminbackend');
      }

      //method that gets a list of all departments in a faculty and puts them in a dropdown
      public function getdepartments($faculty_id) {
          $departments = $this->Results->Departments->find('list', ['limit' => 200])
                  ->where(['faculty_id' => $faculty_id]);
          $this->set(compact('departments'));
      }

      //student method for checking their results
      public function myresults() {
          $student = $this->Results->Students->find()->contain(['Departments'])
                          ->where(['user_id' => $this->Auth->user('id')])->first();
          if ($this->request->is('post')) {

              $session_id = $this->request->getData('session_id');
              $semester_id = $this->request->getData('semester_id');
              $course_id = $this->request->getData('subject_id');
              $conditions = [];
              if (!empty($semester_id)) {
                  $conditions['Results.semester_id'] = $semester_id;
              }
              if (!empty($course_id)) {
                  $conditions['Results.subject_id'] = $course_id;
              }
              if (!empty($session_id)) {
                  $conditions['Results.session_id'] = $session_id;
              }
              $results = $this->Results->find()
                      ->contain(['Faculties', 'Departments', 'Subjects', 'Semesters', 'Sessions'])
                      ->where(['student_id' => $student->id])
                      ->where($conditions);
              //debug(json_encode($conditions, JSON_PRETTY_PRINT)); exit;
              $this->set('results', $results);
          } else {
              $results = $this->Results->find()
                      ->contain(['Faculties', 'Departments', 'Subjects', 'Semesters', 'Sessions'])
                      ->where(['student_id' => $student->id]);

              //debug(json_encode($conditions, JSON_PRETTY_PRINT)); exit;
              $this->set('results', $results);
          }

          $subjects = $this->Results->Subjects->find('list', ['limit' => 200]);
          $semesters = $this->Results->Semesters->find('list', ['limit' => 200]);
          $sessions = $this->Results->Sessions->find('list', ['limit' => 200]);
          $this->set(compact('result', 'subjects', 'semesters', 'sessions', 'student'));

          $this->viewBuilder()->setLayout('adminbackend');
      }

      /**
       * Delete method
       *
       * @param string|null $id Result id.
       * @return \Cake\Http\Response|null Redirects to index.
       * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
       */
      public function delete($id = null) {
          $this->request->allowMethod(['post', 'delete']);
          $result = $this->Results->get($id);
          if ($this->Results->delete($result)) {
              //log activity
              $usercontroller = new UsersController();

              $title = "Deleted a Result ";
              $user_id = $this->Auth->user('id');
              $description = "Deleted a result " . $result->id;
              $ip = $this->request->clientIp();
              $type = "Delete";
              $usercontroller->makeLog($title, $user_id, $description, $ip, $type);
              $this->Flash->success(__('The result has been deleted.'));
          } else {
              $this->Flash->error(__('The result could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'manageresults']);
      }

  }
  