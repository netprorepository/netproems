
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <!--          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>-->
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                             <h1 class="h4 text-gray-900 mb-4">Result Manager</h1>
                        </div>
                        <?= $this->Form->create(null) ?>
                        <fieldset>
      
                            <div class="form-group row">
                                 <div class="col-sm-4">
                                    <?= $this->Form->control('subject_id', ['options' => $subjects,'label' => 'Select Course', 'required', 'placeholder' => 'Select Course'
                                        , 'class' => 'form-control'])
                                    ?>
                                </div>
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
                                                
                                </div>
                          
                        </fieldset>
                        <br /> <br />
<?= $this->Form->button('Search', ['class' => 'btn btn-primary btn-user btn-block']) ?>
<?= $this->Form->end() ?>

                    </div>
                </div>
                
               <?php if(!empty($results)){   ?>
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
<!--                <th scope="col" class="actions"><?= __('Actions') ?></th>-->
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
<!--                <th scope="col" class="actions"><?= __('Actions') ?></th>-->
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
                <td><?= h(date('d M Y H:i a', strtotime($result->uploaddate))) ?></td>
                <td><?= $result->has('user') ? $this->Html->link($result->user->username, ['controller' => 'Users', 'action' => 'view', $result->user->id]) : '' ?></td>
                <td><?= h($result->regno) ?></td>
                <td><?= $this->Number->format($result->creditload) ?></td>
<!--                <td class="actions">
                  
                    <?= $this->Html->link(__(' '), ['action' => 'updateresult', $result->id],['class'=>'btn btn-round btn-primary fa fa-edit','title'=>'update result']) ?>
                    <?= $this->Form->postLink(__(' '), ['action' => 'delete', $result->id], ['confirm' => __('Are you sure you want to delete # {0}?', $result->id),'class'=>'btn btn-round btn-danger fa fa-times-circle','title'=>'delete result']) ?>
                </td>-->
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
               <?php } ?>
                
            </div>
        </div>
    </div>

</div>

