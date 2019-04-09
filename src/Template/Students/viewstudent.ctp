<?php
$userdata = $this->request->getSession()->read('usersinfo');
?>
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Student Profile</h1>
  </div><!--/end d-sm-flex-->
  <div class="row">
  <!-- Pie Chart -->
  <div class="col-xl-4 col-lg-5 col-sm-12 col-md-12 col-xs-12">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Regno : <?= h($student->regno) ?></h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
         <?=  $this->Html->image($student->passporturl, ['alt' => 'EMS', 'class' => 'img-responsive avatar-view', "width"=>"100%", "height"=>"300px"])?>
      </div>
      <!--/end card body-->
    </div>
    <!--/end card-->
  </div>
  <!--/end col-xl-4-->

  <!-- Area Chart -->
  <div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Overview</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Name</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $student->fname . " " . $student->lname ." ".$student->mname?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user fa-2x text-gray-300"></i>
          </div>
        </div>
        <!--/end no-gutters-->
        <hr/>
        
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Date Of Birth</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $student->dob?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
        <!--/end no-gutters-->
        <hr/>
        
         <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Father's Name</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= h($student->fathersname.'  - ('.$student->fathersjob.', '.$student->fatherphone.')') ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-plus fa-2x text-gray-300"></i>
          </div>
        </div>
        <!--/end no-gutters-->
        <hr/>
        
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Mother's Name</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= h($student->mothersname.'  - ('.$student->mothersjob.', '.$student->motherphone.')') ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-plus fa-2x text-gray-300"></i>
          </div>
        </div>
        <!--/end no-gutters-->
        <hr/>
        
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Email</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $student->user->username ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-envelope fa-2x text-gray-300"></i>
          </div>
        </div>
        <!--/end no-gutters-->
        <hr/>
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Phone</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $student->phone ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-phone fa-2x text-gray-300"></i>
          </div>
        </div>
        <!--/end no-gutters-->
        <hr/>
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Address</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $student->address ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-map-marker fa-2x text-gray-300"></i>
          </div>
        </div>
        <!--/end no-gutters-->
        <hr/>
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Department</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $student->department->name ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-home fa-2x text-gray-300"></i>
          </div>
        </div>
        <!--/end no-gutters-->
        <hr/>
         <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">State</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $student->state->name ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-globe fa-2x text-gray-300"></i>
          </div>
        </div>
        <!--/end no-gutters-->
        <hr/>
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Country</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $student->country->name ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-globe fa-2x text-gray-300"></i>
          </div>
        </div>
        <!--/end no-gutters-->
        <hr/>
       
      </div>
    </div>
    <!--/end card-->
  </div>
  <!--/end col-xl-8-->
</div>















<div class="students view large-9 medium-8 columns content">
    <h3><?= h($student->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Fname') ?></th>
            <td><?= h($student->fname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lname') ?></th>
            <td><?= h($student->lname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mname') ?></th>
            <td><?= h($student->mname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dob') ?></th>
            <td><?= h($student->dob) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $student->has('department') ? $this->Html->link($student->department->name, ['controller' => 'Departments', 'action' => 'view', $student->department->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Olevelresulturl') ?></th>
            <td><?= h($student->olevelresulturl) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Birthcerturl') ?></th>
            <td><?= h($student->birthcerturl) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Othercerts') ?></th>
            <td><?= h($student->othercerts) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($student->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= $student->has('state') ? $this->Html->link($student->state->name, ['controller' => 'States', 'action' => 'view', $student->state->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= $student->has('country') ? $this->Html->link($student->country->name, ['controller' => 'Countries', 'action' => 'view', $student->country->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($student->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($student->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fathersname') ?></th>
            <td><?= h($student->fathersname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mothersname') ?></th>
            <td><?= h($student->mothersname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fatherphone') ?></th>
            <td><?= h($student->fatherphone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Motherphone') ?></th>
            <td><?= h($student->motherphone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fathersjob') ?></th>
            <td><?= h($student->fathersjob) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mothersjob') ?></th>
            <td><?= h($student->mothersjob) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Passporturl') ?></th>
            <td><?= h($student->passporturl) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $student->has('user') ? $this->Html->link($student->user->username, ['controller' => 'Users', 'action' => 'view', $student->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Regno') ?></th>
            <td><?= h($student->regno) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($student->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Jamb') ?></th>
            <td><?= $this->Number->format($student->jamb) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Joindate') ?></th>
            <td><?= h($student->joindate) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Fees') ?></h4>
        <?php if (!empty($student->fees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Startdate') ?></th>
                <th scope="col"><?= __('Enddate') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($student->fees as $fees): ?>
            <tr>
                <td><?= h($fees->id) ?></td>
                <td><?= h($fees->name) ?></td>
                <td><?= h($fees->amount) ?></td>
                <td><?= h($fees->user_id) ?></td>
                <td><?= h($fees->status) ?></td>
                <td><?= h($fees->startdate) ?></td>
                <td><?= h($fees->enddate) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Fees', 'action' => 'view', $fees->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Fees', 'action' => 'edit', $fees->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Fees', 'action' => 'delete', $fees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fees->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Subjects') ?></h4>
        <?php if (!empty($student->subjects)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Subjectcode') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Creditload') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created Date') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($student->subjects as $subjects): ?>
            <tr>
                <td><?= h($subjects->id) ?></td>
                <td><?= h($subjects->name) ?></td>
                <td><?= h($subjects->subjectcode) ?></td>
                <td><?= h($subjects->department_id) ?></td>
                <td><?= h($subjects->creditload) ?></td>
                <td><?= h($subjects->user_id) ?></td>
                <td><?= h($subjects->created_date) ?></td>
                <td><?= h($subjects->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Subjects', 'action' => 'view', $subjects->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Subjects', 'action' => 'edit', $subjects->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Subjects', 'action' => 'delete', $subjects->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subjects->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
