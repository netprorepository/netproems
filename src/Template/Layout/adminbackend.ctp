<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="NetPro EMS">
        <meta name="author" content="NetPro Int'l">

        <link rel="icon" href="/img/logo-icon.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $this->Html->meta('logo-icon.png') ?>
        <title>NETPRO EMS  </title>

        <!-- Custom fonts for this template-->
        <?=
          $this->Html->css(['all.min', 'sb-admin-2.min', 'dataTables.bootstrap4.min', 'daterangepicker', 'bootstrap-timepicker.min', 'custom', 'select2.min', 'summernote/summernote'])
        ?>
        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
                <?php
                  $user = $this->request->getSession()->read('usersinfo');
                  $settings = $this->request->getSession()->read('settings');
                  $is_owing =  $this->request->getSession()->read('is_owing');
                ?>
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3"> <?= $user['lname'] ?> <sup><?= $user['id'] ?></sup></div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <?php // debug(json_encode( $user['role_id'], JSON_PRETTY_PRINT)); exit;
                      if($user['role_id']===3){   echo $this->Html->link(' Dashboard', ['controller' => 'Teachers', 'action' => 'dashboard'], ['title' => 'teachers dashboard', 'class' => 'nav-link fas fa-fw fa-tachometer-alt']);
                
            }
             elseif($user['role_id']==2){
                     echo $this->Html->link(' Dashboard', ['controller' => 'Students', 'action' => 'dashboard'], ['title' => 'students dashboard', 'class' => 'nav-link fas fa-fw fa-tachometer-alt']);
                   
                    }
                    elseif($user['role_id']==1){
                      echo $this->Html->link(' Dashboard', ['controller' => 'Users', 'action' => 'dashboard'], ['title' => 'admins dashboard', 'class' => 'nav-link fas fa-fw fa-tachometer-alt']);
                    
                    }
            ?>
<!--                    <a class="nav-link" href="../users/dashboard">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>-->
                   
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Interface
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <?php if ($user['role_id'] == 1) { ?>
                      <li class="nav-item">
                          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                              <i class="fas fa-fw fa-cog"></i>
                              <span>Admin</span>
                          </a>
                          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                              <div class="bg-white py-2 collapse-inner rounded">
                                  <h6 class="collapse-header">Manage Admins:</h6>
                                  <?php
                                  echo $this->Html->link('Manage Admins', ['controller' => 'Users', 'action' => 'manageadmins'], ['title' => 'manage admins', 'class' => 'collapse-item']);
                                  echo $this->Html->link('New Admin', ['controller' => 'Admins', 'action' => 'newadmin'], ['title' => 'add new admin', 'class' => 'collapse-item']);
                                echo '<h6 class="collapse-header">Manage Teachers</h6>';
                                  echo $this->Html->link('Manage Teacher', ['controller' => 'Teachers', 'action' => 'manageteachers'], ['title' => 'Manage Teachers', 'class' => 'collapse-item']);
      echo $this->Html->link('Assign Subject', ['controller' => 'Teachers', 'action' => 'assignsubjectstoteacher'], ['title' => 'Assign Subjects', 'class' => 'collapse-item']);
     
                                    ?>
                              </div>
                          </div>
                      </li>

                       <li class="nav-item">
                          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#roles" aria-expanded="true" aria-controls="collapseTwo">
                              <i class="fas fa-fw fa-cog"></i>
                              <span>Roles</span>
                          </a>
                          <div id="roles" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                              <div class="bg-white py-2 collapse-inner rounded">
                                  <h6 class="collapse-header">Manage Roles:</h6>
                                  <?php
                               
                                  echo $this->Html->link('Manage Roles', ['controller' => 'Roles', 'action' => 'manageroles'], ['title' => 'manage roles', 'class' => 'collapse-item']);
 ?> </div>
                          </div>
                      </li>
                      
                      <li class="nav-item">
                          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#invoices" aria-expanded="true" aria-controls="collapseTwo">
                              <i class="fas fa-fw fa-cog"></i>
                              <span>Reports</span>
                          </a>
                          <div id="invoices" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                              <div class="bg-white py-2 collapse-inner rounded">
                                  <h6 class="collapse-header">Manage Reports:</h6>
                                  <?php
                               
                                  echo $this->Html->link('View Invoices', ['controller' => 'Invoices', 'action' => 'index'], ['title' => 'view invoices', 'class' => 'collapse-item']);
                                  echo $this->Html->link('View Transactions', ['controller' => 'Transactions', 'action' => 'index'], ['title' => 'view transactions', 'class' => 'collapse-item']);

                                  ?> </div>
                          </div>
                      </li>
                      
                        <li class="nav-item">
                          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#results" aria-expanded="true" aria-controls="collapseTwo">
                              <i class="fas fa-fw fa-cog"></i>
                              <span>Resultts</span>
                          </a>
                          <div id="results" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                              <div class="bg-white py-2 collapse-inner rounded">
                                  <h6 class="collapse-header">Manage Results:</h6>
                                  <?php
                               
                                  echo $this->Html->link('Manageresults', ['controller' => 'Results', 'action' => 'manageresults'], ['title' => 'manage results', 'class' => 'collapse-item']);
                                  echo $this->Html->link('Upload Results', ['controller' => 'Results', 'action' => 'uploadresults'], ['title' => 'upload results', 'class' => 'collapse-item']);

                                  ?> </div>
                          </div>
                      </li>
                      
                       <li class="nav-item">
                          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#fees" aria-expanded="true" aria-controls="collapseTwo">
                              <i class="fas fa-fw fa-cog"></i>
                              <span>Finance</span>
                          </a>
                          <div id="fees" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                              <div class="bg-white py-2 collapse-inner rounded">
                             <?php  echo'<h6 class="collapse-header">Manage Fees:</h6>';
                                  echo $this->Html->link('Manage Fees', ['controller' => 'Fees', 'action' => 'managefees'], ['title' => 'manage fees', 'class' => 'collapse-item']);
                                  echo'<h6 class="collapse-header">Fee Allocations:</h6>';
                                  echo $this->Html->link('Allocate To Department', ['controller' => 'Feeallocations', 'action' => 'managefeeallocations'], ['title' => 'manage fee allocations', 'class' => 'collapse-item']);
                                  echo $this->Html->link('Allocate To Student', ['controller' => 'Feeallocations', 'action' => 'managefeeallocations'], ['title' => 'manage fee allocations', 'class' => 'collapse-item']);
                                  
                             ?> </div>
                          </div>
                      </li>
                      
                      
                      <li class="nav-item">
                          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#academics" aria-expanded="true" aria-controls="collapseTwo">
                              <i class="fas fa-fw fa-cog"></i>
                              <span>Academics</span>
                          </a>
                          <div id="academics" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                              <div class="bg-white py-2 collapse-inner rounded">
                                  <h6 class="collapse-header">Manage Academics:</h6>
                                  <?php
                               
                                  echo $this->Html->link('Manage Faculties', ['controller' => 'Faculties', 'action' => 'managefaculties'], ['title' => 'manage faculties', 'class' => 'collapse-item']);
                                  echo $this->Html->link('Manage Departments', ['controller' => 'Departments', 'action' => 'managedepartments'], ['title' => 'manage departments', 'class' => 'collapse-item']);
                                  echo $this->Html->link('Manage Programes', ['controller' => 'Programes', 'action' => 'manageprogrames'], ['title' => 'manage programes', 'class' => 'collapse-item']);
                                echo ' <h6 class="collapse-header">Manage Subject:</h6>';
                                  echo $this->Html->link('Manage Subjects', ['controller' => 'Subjects', 'action' => 'managesubjects'], ['title' => 'Manage Subject', 'class' => 'collapse-item']);
                                  echo $this->Html->link('Manage Topics', ['controller' => 'Topics', 'action' => 'managetopics'], ['title' => 'Manage Topics', 'class' => 'collapse-item']);
                                  echo ' <h6 class="collapse-header">Manage Sesion:</h6>';
                                  echo $this->Html->link('Manage Sessions', ['controller' => 'Sessions', 'action' => 'managesessions'], ['title' => 'manage manage sessions', 'class' => 'collapse-item']);
                                  echo ' <h6 class="collapse-header">Manage Semester:</h6>';
                                  echo $this->Html->link('Manage Semesters', ['controller' => 'Semesters', 'action' => 'managesemesters'], ['title' => 'manage manage sessions', 'class' => 'collapse-item']);
                                   echo ' <h6 class="collapse-header">Transcript Requests :</h6>';
                                  echo $this->Html->link('Manage Requests', ['controller' => 'Admins', 'action' => 'managetranscriptorders'], ['title' => 'manage transcript requests', 'class' => 'collapse-item']);
                                  
                                  ?> 
                              
                              
                              </div>
                              
                          </div>
                      </li>

                      <li class="nav-item">
                          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
                              <i class="fas fa-fw fa-cog"></i>
                              <span>Students</span>
                          </a>
                          <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                              <div class="bg-white py-2 collapse-inner rounded">
                                  <h6 class="collapse-header">Manage Students:</h6>
                                  <?php
                                  echo $this->Html->link('List Students', ['controller' => 'Students', 'action' => 'managestudents'], ['title' => 'Manage Students', 'class' => 'collapse-item']);
                                   echo $this->Html->link('Add Student', ['controller' => 'Students', 'action' => 'newstudent'], ['title' => 'Manage Students', 'class' => 'collapse-item']);
                                 echo $this->Html->link('Import Students', ['controller' => 'Students', 'action' => 'importstudents'], ['title' => 'bulk import Students', 'class' => 'collapse-item']);
                                 echo $this->Html->link('Students Promotion', ['controller' => 'Students', 'action' => 'promotestudents'], ['title' => 'promote Students', 'class' => 'collapse-item']);
                                
                                  ?>
                                 
                              </div>
                          </div>
                      </li>
                      
                       <li class="nav-item">
                          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#admission" aria-expanded="true" aria-controls="collapseTwo">
                              <i class="fas fa-fw fa-cog"></i>
                              <span>Admission</span>
                          </a>
                          <div id="admission" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                              <div class="bg-white py-2 collapse-inner rounded">
      <?php
                                  echo $this->Html->link('Application Form', ['controller' => 'Students', 'action' => 'newapplicant'], ['title' => 'Manage Applicants', 'class' => 'collapse-item']);
                                  echo $this->Html->link('Direct Admission', ['controller' => 'Students', 'action' => 'newstudent'], ['title' => 'Direct admision', 'class' => 'collapse-item']);
                                  echo $this->Html->link('Applicants List', ['controller' => 'Students', 'action' => 'manageapplicants'], ['title' => 'Manage Applicants', 'class' => 'collapse-item']);
                                 
                                  ?>
                              </div>
                          </div>
                      </li>
                      
                       <li class="nav-item">
                          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#messages" aria-expanded="true" aria-controls="collapseTwo">
                              <i class="fas fa-fw fa-cog"></i>
                              <span>Messages</span>
                          </a>
                          <div id="messages" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                              <div class="bg-white py-2 collapse-inner rounded">
      <?php
                                  echo $this->Html->link('Message To Students', ['controller' => 'Students', 'action' => 'newmessagetostudents'], ['title' => 'Manage Applicants', 'class' => 'collapse-item']);
                                  echo $this->Html->link('Message To Teachers', ['controller' => 'Teachers', 'action' => 'newmessagetoteachers'], ['title' => 'Direct admision', 'class' => 'collapse-item']);
                                  echo $this->Html->link('Message To Parents', ['controller' => 'Users', 'action' => 'newmessagetoparents'], ['title' => 'Manage Applicants', 'class' => 'collapse-item']);
                                 echo $this->Html->link('Notifications', ['controller' => 'Notifications', 'action' => 'index'], ['title' => 'Manage Notifications', 'class' => 'collapse-item']);
                                 
                                  ?>
                              </div>
                          </div>
                      </li>

  <?php } ?>

                <!-- Nav Item - Utilities Collapse Menu used for students
                <?php if ($user['role_id'] == 2 || $user['role_id']==1) { ?>
                      <li class="nav-item">
                          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                              <i class="fas fa-fw fa-wrench"></i>
                              <span>Utilities</span>
                          </a>
                          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                              <div class="bg-white py-2 collapse-inner rounded">
                                  <h6 class="collapse-header"> Utilities:</h6>
      <?= $this->Html->link('My Courses', ['controller' => 'Students', 'action' => 'mycourses'], ['title' => 'My Courses', 'class' => 'collapse-item']) ?>

                                  <?= $this->Html->link('My Invoices', ['controller' => 'Students', 'action' => 'myinvoices'], ['title' => 'My Courses', 'class' => 'collapse-item']) ?>

                                  
                              </div>
                          </div>
                      </li>
  <?php } ?>
                -->

                <!-- Divider -->
                <hr class="sidebar-divider">
  <?php if ( $user['role_id']==1) { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#settings" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Settings</span>
                    </a>
                    <div id="settings" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            
<?php
     
                                  echo $this->Html->link('System Settings', ['controller' => 'Settings', 'action' => 'editsettings', 1], ['title' => 'update system system', 'class' => 'collapse-item']);
                               echo $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout', 1], ['title' => 'log out', 'class' => 'collapse-item']);
                                 
  
?>
                        </div>
                    </div>
                </li>
  <?php } ?>
                <!-- Heading -->
                <div class="sidebar-heading">
                    Addons
                </div>
 <?php  if ($user['role_id'] == 2 || $user['role_id'] == 3) {?>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Academics</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Course Manager:</h6>
                           
<?php
  if ($user['role_id'] == 3) {
      echo $this->Html->link(__(' My Courses'), ['controller' => 'Teachers', 'action' => 'assignedcourses'], ['class' => 'collapse-item', 'title' => 'view assigned courese']);
      echo $this->Html->link(__(' Manage Topics'), ['controller' => 'Teachers', 'action' => 'mytopics'], ['class' => 'collapse-item', 'title' => 'view and update topics']);
     echo $this->Html->link(__(' Upload Materials'), ['controller' => 'Coursematerials', 'action' => 'uploadmaterial'], ['class' => 'collapse-item', 'title' => 'upload course materials']);
 
       }
  if ($user['role_id'] == 2 & empty($is_owing)) {
      echo $this->Html->link(__(' My Courses'), ['controller' => 'Students', 'action' => 'mycourses'], ['class' => 'collapse-item', 'title' => 'view assigned courese']);
      echo $this->Html->link(__(' Course Materials'), ['controller' => 'Students', 'action' => 'coursematerials'], ['class' => 'collapse-item', 'title' => 'course materials']);
    
      echo $this->Html->link(__(' My Results'), ['controller' => 'Results', 'action' => 'myresults'], ['class' => 'collapse-item', 'title' => 'check results']);
    echo $this->Html->link(__(' Request Transcript'), ['controller' => 'Students', 'action' => 'requesttrnscript'], ['class' => 'collapse-item', 'title' => 'request for transcript']);
    
       }
?>
                        </div>
                    </div>
                </li>
                
                 <?php if ( $user['role_id']==3) { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tresults" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Results</span>
                    </a>
                    <div id="tresults" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            
<?php
     
                                  echo $this->Html->link('Upload Results', ['controller' => 'Teachers', 'action' => 'uploadresults'], ['title' => 'upload students results', 'class' => 'collapse-item']);
                               echo $this->Html->link('manage Results', ['controller' => 'Teachers', 'action' => 'manageresults'], ['title' => 'manage results', 'class' => 'collapse-item']);
                                 
  
?>
                        </div>
                    </div>
                </li>
  <?php } ?>
                
 <?php } if ($user['role_id'] == 2 || $user['role_id'] == 3) {?>
                 <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#myaccount" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>My Account</span>
                    </a>
                    <div id="myaccount" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            
<?php
     if($user['role_id'] == 3){
                             echo $this->Html->link(__(' Update Profile'), ['controller' => 'Teachers', 'action' => 'updateprofile'], ['class' => 'collapse-item','title'=>'update my profile']);
      echo $this->Html->link(__(' View Profile'), ['controller' => 'Teachers', 'action' => 'viewprofile'], ['class' => 'collapse-item','title'=>'view my profile']);
     }
     if($user['role_id'] == 2 & empty($is_owing)){
         echo $this->Html->link(__(' View Profile'), ['controller' => 'Students', 'action' => 'viewprofile'], ['class' => 'collapse-item','title'=>'view my profile']);
      echo $this->Html->link(__(' My Invoices'), ['controller' => 'Students', 'action' => 'myinvoices'], ['class' => 'collapse-item','title'=>'view my invoices']);
     
     }
   //  echo $this->Html->link(__(' Change Password'), ['controller' => 'Users', 'action' => 'changepassword'], ['class' => 'collapse-item','title'=>'change my password']);
    
?>
                          
                            
                        </div>
                    </div>
                </li>
              <?php  }
              
              if ($user['role_id'] == 2 || $user['role_id'] == 3) {?>
                 <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#messaging" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Messaging</span>
                    </a>
                    <div id="messaging" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            
<?php
     if($user['role_id'] == 3){
                             echo $this->Html->link(__(' Contact Admin'), ['controller' => 'Teachers', 'action' => 'messagetoadmin'], ['class' => 'collapse-item','title'=>'send a message to the system admin']);
      echo $this->Html->link(__(' Message To Students'), ['controller' => 'Teachers', 'action' => 'messagetostudents'], ['class' => 'collapse-item','title'=>'send message to my students']);
     }
     if($user['role_id'] == 2 & empty($is_owing)){
         echo $this->Html->link(__(' Contact Admin'), ['controller' => 'Students', 'action' => 'contactadmin'], ['class' => 'collapse-item','title'=>'contact system admin']);
      echo $this->Html->link(__(' Contact Lecturer'), ['controller' => 'Students', 'action' => 'contactlecturer'], ['class' => 'collapse-item','title'=>'contact lecturer']);
     
     }
       
?>
                          
                            
                        </div>
                    </div>
                </li>
              <?php  }?>
                
                <!--  
                <li class="nav-item">
                    <a class="nav-link" href="charts.html">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Charts</span></a>
                </li>

               
                <li class="nav-item">
                    <a class="nav-link" href="tables.html">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Tables</span></a>
                </li>
-->
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Search -->
                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <!-- Counter - Alerts -->
                                    <span class="badge badge-info badge-counter">1+</span>
                                </a>
                                <!-- Dropdown - Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">
                                        Alerts Center
                                    </h6>
                                                      <?php
  //the cell that renders sports news 

  $notification_cell = $this->cell('nems::getnotifications', ['cache' => true]);
  echo $notification_cell ;
?>
<!--                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-success">
                                                <i class="fas fa-donate text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 7, 2019</div>
                                            $290.29 has been deposited into your account!
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-warning">
                                                <i class="fas fa-exclamation-triangle text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 2, 2019</div>
                                            Spending Alert: We've noticed unusually high spending for your account.
                                        </div>
                                    </a>
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>-->
                                </div>
                            </li>

                            <!-- Nav Item - Messages -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-envelope fa-fw"></i>
                                    <!-- Counter - Messages -->
                                    <span class="badge badge-danger badge-counter">7</span>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                    <h6 class="dropdown-header">
                                        Message Center
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                                            <div class="small text-gray-500">Jae Chun · 1d</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                                            <div class="status-indicator bg-warning"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                                            <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                                            <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                                </div>
                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['fname'] . ' ' . $user['lname'] ?></span>
       <?php // debug(json_encode( $user['role_id'], JSON_PRETTY_PRINT)); exit;
                      if($user['role_id']===3){ 
                          $dteacher = $this->request->getSession()->read('teacher');
                       
                        echo $this->Html->image($dteacher->passport, ['alt' => 'EMS', 'class' => 'img-profile rounded-circle']);
                
            }
             elseif($user['role_id']==2){
             
                      $student = $this->request->getSession()->read('student');
                         echo $this->Html->image($student->passporturl, ['alt' => 'EMS', 'href' => '/', 'class' => 'img-profile rounded-circle']);
                
                    }
                    elseif($user['role_id']==1){
                    echo $this->Html->image($user['passport'], ['alt' => 'EMS', 'href' => '/', 'class' => 'img-profile rounded-circle']);
                    }
            ?>
                                        </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                  <?php if ( $user['role_id']==1) {  
                                                                 
                                     echo $this->Html->link(
             $this->Html->tag('i', '', array('class' => 'fas fa-cogs fa-sm fa-fw mr-2 text-gray-400')).' Profile', 
             array('controller' => 'Users', 'action' => 'myprofile'), array('escape' => false,'class'=>'dropdown-item')
          );
                                      
                             echo $this->Html->link(
             $this->Html->tag('i', '', array('class' => 'fas fa-cogs fa-sm fa-fw mr-2 text-gray-400')).' System Settings', 
             array('controller' => 'Settings', 'action' => 'editsettings',1), array('escape' => false,'class'=>'dropdown-item','title'=>'update system settings')
          );
                                
                                   echo $this->Html->link(
             $this->Html->tag('i', '', array('class' => 'fas fa-cogs fa-sm fa-fw mr-2 text-gray-400')).' Activity Log', 
             array('controller' => 'Logs', 'action' => 'mylogs'), array('escape' => false,'class'=>'dropdown-item','title'=>'activity logs')
          );
                                   
                                 }?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
<?= $this->Flash->render() ?>
                       
                        <?= $this->fetch('content') ?>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; NetPro Int'l, 2019</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<?=
  $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout', $user['id']], ['title' => 'logout',
      'class' => 'btn btn-primary'])
?>

                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->

<?=
  $this->Html->script(['jquery.min', 'bootstrap.bundle.min', 'jquery.easing.min', 'sb-admin-2.min',
      'Chart.min', 'chart-pie-demo', 'chart-area-demo', 'jquery.dataTables.min', 'dataTables.bootstrap4.min',
      'datatables-demo', 'bootstrap-timepicker.min', 'bootstrap-datepicker.min', 'select2.full.min', 
      'summernote.init', 'summernote.min','employerscript'])
?>

        <?= $this->fetch('script') ?>

        <!-- bootstrap-daterangepicker -->
        <script>
            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });
            //Date picker
            $('#datepicker2').datepicker({
                autoclose: true
            });
            $(document).ready(function () {
                $(".select2_single").select2({
                    placeholder: "Select a from The List",
                    allowClear: true
                });
                $(".select2_group").select2({});
                $(".select2_multiple").select2({
                   // maximumSelectionLength: 14,
                   // placeholder: "With Max Selection limit 14",
                    allowClear: true
                });
            });
            
            
            
            
        </script>
        <script>
function getnotificationdata(noteid){
              //  alert(noteid);
                 $.ajax({
        url: '../Notifications/getnote/'+noteid,
        method: 'GET',
        dataType: 'text',
        success: function(response) {
            //console.log(response);
           // $('#noteModal').modal('show'); 
           
            document.getElementById('notify').innerHTML = "";
            document.getElementById('notify').innerHTML = response;
            //location.href = redirect;
        }
    });

            }
            </script>
           
    </body>

</html>
