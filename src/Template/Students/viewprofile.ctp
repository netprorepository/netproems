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
        <h6 class="m-0 font-weight-bold text-primary">Regno : <?=$student->regno?></h6>
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
          <h6 class="m-0 font-weight-bold text-primary">Student Overview
             </h6>
           <span class="float-right">
        <?= $this->Html->link(__('Update Profile'), ['controller' => 'Students', 'action' => 'updateprofile'],['class'=>'float-right']) ?>
              </span>
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
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Email</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $student->email ?></div>
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
        
        Parents/Guardians
         <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Father</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $student->fathersname.' - '. $student->fatherphone?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user fa-2x text-gray-300"></i>
          </div>
        </div>
        <!--/end no-gutters-->
        <hr/>
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Mother</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $student->mothersname.' - '. $student->motherphone?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user fa-2x text-gray-300"></i>
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

