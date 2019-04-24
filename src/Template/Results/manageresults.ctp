<?php
$userdata = $this->request->getSession()->read('usersinfo');
$userrole = $this->request->getSession()->read('usersroles');
?>


<!-- Begin Page Content -->
        <div class="container-fluid">
            <div style="padding-bottom: 10px; margin-bottom: 20px;"><?= $this->Html->link(__(' '), ['action' => 'newresult'],
                            ['class'=>'btn-circle btn-lg fa fa-plus float-right','title'=>'add student result']) ?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Manage Results</h1></div>
           <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                             <h1 class="h4 text-gray-900 mb-4">Search Result</h1>
                        </div>
                        <?= $this->Form->create(null) ?>
                        <fieldset>

                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                <?= $this->Form->control('faculty_id', ['options' => $faculties, 'label' => 'Select Faculty',
                                        'placeholder' => 'Faculty', 'class' => 'form-control','onChange'=>'getdepartments(this.value)'])
                                    ?>     
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?= $this->Form->control('department_id', ['options' => $departments, 'required', 'label' =>'Select Department',
                                        'placeholder' => 'Select Department', 'class' => 'form-control','id'=>'dept1'])
                                    ?>
                                </div>

                                <div class="col-sm-4">
                                    <?= $this->Form->control('subject_id', ['options' => $subjects,'label' => 'Select Course', 'required', 'placeholder' => 'Select Course'
                                        , 'class' => 'form-control'])
                                    ?>
                                </div>
                            </div>
                                
                            <div class="form-group row">
                           <div class="col-sm-4">
                                    <?= $this->Form->control('semester_id', ['options' => $semesters,'label' => 'Select Semester', 'required', 'placeholder' => 'Select Semester'
                                        , 'class' => 'form-control'])
                                    ?>
                                </div>  
                                <div class="col-sm-4">
                                    <?= $this->Form->control('session_id', ['options' => $sessions,'label' => 'Select Session', 'required', 'placeholder' => 'Select Session'
                                        , 'class' => 'form-control'])
                                    ?>
                                </div>
                                <div class="col-sm-4">
                                 <?= $this->Form->control('student_id', ['options' => $students,'label' => 'Select Student', 'title' => 'Select Student'
                                        , 'class' => 'form-control'])?>
                                               
                                </div>
                           </div>
                        </fieldset>
                        <br /> <br />
<?= $this->Form->button('Search', ['class' => 'btn btn-primary btn-user btn-block']) ?>
<?= $this->Form->end() ?>

                    </div>
                </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Results Manager</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
            <tr>
              
                <th>Student</th>
                <th>faculty</th>
                <th>Department</th>
                <th>Course</th>
                <th >Semester</th>
                <th >Session</th>
                <th>Score</th>
                <th>Grade</th>
                <th >Remark</th>
                <th >Upload Date</th>
                <th> Admin </th>
                <th>Regno</th>
                <th >Credit Load</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
                  <tfoot>
                       <tr>
              
                <th>Student</th>
                <th>faculty</th>
                <th>Department</th>
                <th>Course</th>
                <th >Semester</th>
                <th >Session</th>
                <th>Score</th>
                <th>Grade</th>
                <th >Remark</th>
                <th >Upload Date</th>
                <th> Admin </th>
                <th>Regno</th>
                <th >Credit Load</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
                  </tfoot>
        </thead>
        <tbody>
            <?php foreach ($results as $result): ?>
            <tr>
              
                <td><?= $result->has('student') ? $this->Html->link($result->student->fname, ['controller' => 'Students', 'action' => 'view', $result->student->id]) : '' ?></td>
                <td><?= $result->has('faculty') ? $this->Html->link($result->faculty->name, ['controller' => 'Faculties', 'action' => 'view', $result->faculty->id]) : '' ?></td>
                <td><?= $result->has('department') ? $this->Html->link($result->department->name, ['controller' => 'Departments', 'action' => 'view', $result->department->id]) : '' ?></td>
                <td><?= $result->has('subject') ? $this->Html->link($result->subject->name, ['controller' => 'Subjects', 'action' => 'view', $result->subject->id]) : '' ?></td>
                <td><?= $result->has('semester') ? $this->Html->link($result->semester->name, ['controller' => 'Semesters', 'action' => 'view', $result->semester->id]) : '' ?></td>
                <td><?= $result->has('session') ? $this->Html->link($result->session->name, ['controller' => 'Sessions', 'action' => 'view', $result->session->id]) : '' ?></td>
                <td><?= $this->Number->format($result->score) ?></td>
                <td><?= h($result->grade) ?></td>
                <td><?= h($result->remark) ?></td>
                <td><?= h($result->uploaddate) ?></td>
                <td><?= $result->has('user') ? $this->Html->link($result->user->username, ['controller' => 'Users', 'action' => 'view', $result->user->id]) : '' ?></td>
                <td><?= h($result->regno) ?></td>
                <td><?= $this->Number->format($result->creditload) ?></td>
                <td class="actions">
                  
                    <?= $this->Html->link(__(' '), ['action' => 'updateresult', $result->id],['class'=>'btn btn-round btn-primary fa fa-edit','title'=>'update result']) ?>
                    <?= $this->Form->postLink(__(' '), ['action' => 'delete', $result->id], ['confirm' => __('Are you sure you want to delete # {0}?', $result->id),'class'=>'btn btn-round btn-danger fa fa-times-circle','title'=>'delete result']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
     </table>
              </div>
            </div>
          </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
