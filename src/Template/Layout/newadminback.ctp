<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="/img/logo-icon.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $this->Html->meta('logo-icon.png') ?>
        <title>NETPRO EMS  </title>

        <?=
        $this->Html->css(['bootstrap.min', 'font-awesome.min', 'daterangepicker', 'bootstrap-timepicker.min', 'nprogress', 'custom.min', 'dataTables.bootstrap.min', 'green',
            'buttons.bootstrap.min', 'fixedHeader.bootstrap.min', 'responsive.bootstrap.min', 'scroller.bootstrap.min',
            'daterangepicker'])
        ?>
        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>

    </head>

    <body class="nav-md"> <?php
        $user = $this->request->getSession()->read('usersinfo');
        $settings = $this->request->session()->read('settings');
         
        ?>
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="/" class="site_title"><i class="fa fa-paw"></i> <span> ADMIN</span></a>
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile">
                            <div class="profile_pic">
                                <?php echo  $this->Html->image($settings['logo'], ['alt' => 'EMS', 'href' => '/', 'class' => 'img-circle profile_img',
                                    'style' => 'width:50px;height:60px;padding: 5px;'])
                                ?>
              <!--                <img src="images/img.jpg" alt="..." class="img-circle profile_img">-->
                            </div>

                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2><?= $user['lname'] ?></h2>
                            </div> 
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>General</h3>
                                <ul class="nav side-menu">
                                    <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><?= $this->Html->link('Dashboard', ['controller' => 'Admins', 'action' => 'admindashboard'], ['title' => 'admin dashboard'])
                                ?></li>
                                        </ul>
                                    </li>
<?php if ($user['role_id'] == 1) { ?>
                                        <li><a><i class="fa fa-users"></i>Admins <span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                                <li><?= $this->Html->link('Manage Admins', ['controller' => 'Users', 'action' => 'manageadmins'], ['title' => 'manage admins'])
    ?></li>
                                                <li><?= $this->Html->link('New Admin', ['controller' => 'Users', 'action' => 'newadmin'], ['title' => 'add new admin'])
    ?></li>
                                                <li><?= $this->Html->link('System Settings', ['controller' => 'Settings', 'action' => 'editsettings', 1], ['title' => 'update system system'])
                                                ?></li>

                                            </ul>
                                        </li>
<?php } ?>  

                                    <li><a><i class="fa fa-edit"></i> Students <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><?= $this->Html->link('Manage Students', ['controller' => 'Admins', 'action' => 'managestudents'], ['title' => 'student manager'])
?></li>
                                            <li><?= $this->Html->link('New Student', ['controller' => 'Admins', 'action' => 'newstudent'], ['title' => 'add new student'])
?></li>

                                            <li><?= $this->Html->link('Upload Students', ['controller' => 'Admins', 'action' => 'uploadstudents'], ['title' => 'bulk upolad of students'])
?></li>

                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-desktop"></i> Departments <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><?= $this->Html->link('Manage Departments', ['controller' => 'Admins', 'action' => 'managedepartments'], ['title' => 'manage departments'])
?></li>
                                            <li><?= $this->Html->link('New Department', ['controller' => 'Admins', 'action' => 'newdepartment'], ['title' => 'add new department'])
?></li>

                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-table"></i> Faculties <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><?= $this->Html->link('Manage Faculties', ['controller' => 'Admins', 'action' => 'managefaculties'], ['title' => 'manage faculties'])
?></li>
                                            <li><?= $this->Html->link('New Faculty', ['controller' => 'Admins', 'action' => 'newfaculty'], ['title' => 'add new faculty'])
?></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-bar-chart-o"></i> Requests <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><?= $this->Html->link('Manage Requests', ['controller' => 'Admins', 'action' => 'managerequests'], ['title' => 'manage requests'])
?></li>

                                            <li><?= $this->Html->link('All Requests', ['controller' => 'Admins', 'action' => 'incompleterequests'], ['title' => 'manage requests'])
?></li>

                                        </ul>
                                    </li>

                                    <li><a><i class="fa fa-table"></i>Results <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><?= $this->Html->link('Search Results', ['controller' => 'Admins', 'action' => 'searchresults'], ['title' => 'manage results'])
?></li>
                                            <li><?= $this->Html->link('Manage Results', ['controller' => 'Admins', 'action' => 'manageresults'], ['title' => 'manage results'])
?></li>
                                            <li><?= $this->Html->link('Upload Result', ['controller' => 'Admins', 'action' => 'uploadresult'], ['title' => 'upload results'])
?></li>
                                        </ul>
                                    </li>

                                    <li><a><i class="fa fa-user-plus"></i>Countries <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><?= $this->Html->link('Manage Countries', ['controller' => 'Admins', 'action' => 'managecountries'], ['title' => 'manage countries'])
?></li>
                                            <li><?= $this->Html->link('Add New Country', ['controller' => 'Admins', 'action' => 'newcountry'], ['title' => 'add new country'])
?></li>
                                        </ul>
                                    </li>

                                    <li><a><i class="fa fa-reddit"></i>Courses <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><?= $this->Html->link('Manage Courses', ['controller' => 'Admins', 'action' => 'managecourses'], ['title' => 'manage courses'])
?></li>
                                            <li><?= $this->Html->link('Add New Course', ['controller' => 'Admins', 'action' => 'newcourse'], ['title' => 'add new course'])
?></li>
                                        </ul>
                                    </li>

                                    <li><a><i class="fa fa-search"></i>Session <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><?= $this->Html->link('New Session', ['controller' => 'Admins', 'action' => 'newsession'], ['title' => 'create new session'])
?></li>
                                            <li><?= $this->Html->link('Manage Sessions', ['controller' => 'Admins', 'action' => 'managesessions'], ['title' => 'add new course'])
?></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-money"></i>Transactions <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><?= $this->Html->link('Manage Transactions', ['controller' => 'Admins', 'action' => 'managetransactions'], ['title' => 'manage transactions'])
?></li>

                                        </ul>
                                    </li>
                                    <li><?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'], ['title' => 'logout'])
?></li>

                                </ul>
                            </div>

                        </div>
                        <!-- /sidebar menu -->

                        <!-- /menu footer buttons -->
                        <!--            <div class="sidebar-footer hidden-small">
                                      <a data-toggle="tooltip" data-placement="top" title="Settings">
                                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                      </a>
                                      <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                                      </a>
                                      <a data-toggle="tooltip" data-placement="top" title="Lock">
                                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                                      </a>
                                      <a data-toggle="tooltip" data-placement="top" title="Logout">
                                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                                      </a>
                                    </div>-->
                        <!-- /menu footer buttons -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
<?= $this->Html->image($user['passport']) ?>
<?= $user['lname'] ?>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li><a href="javascript:;"> Profile</a></li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="badge bg-red pull-right">50%</span>
                                                <span>Settings</span>
                                            </a>
                                        </li>
                                        <li><a href="javascript:;">Help</a></li>
                                        <li><?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout', $user['id']], ['title' => 'logout'])
?></li>
                                    </ul>
                                </li>

                                <li role="presentation" class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-envelope-o"></i>
                                        <span class="badge bg-green">6</span>
                                    </a>
                                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                        <li>
                                            <a>
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="text-center">
                                                <a>
                                                    <strong>See All Alerts</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <!-- main content -->
                <?= $this->Flash->render() ?>

<?= $this->fetch('content') ?>
                <!-- main content -->
                <!-- /page content -->

                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        NetPro Education Management System <a href="https://www.netpro.com.ng">NetPro.</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>
        <?=
        $this->Html->script(['jquery.min', 'bootstrap.min', 'fastclick', 'nprogress', 'bootstrap-timepicker.min',
            'bootstrap-datepicker.min',
            'jquery.dataTables.min', 'dataTables.bootstrap.min',
            'dataTables.buttons.min', 'buttons.flash.min', 'buttons.html5.min', 'dataTables.fixedHeader.min', 'buttons.print.min'
            , 'dataTables.keyTable.min', 'dataTables.responsive.min', 'responsive.bootstrap', 'dataTables.scroller.min',
            'jszip.min', 'pdfmake.min', 'vfs_fonts', 'fastclick', 'custom.min', 'jspdf'])
        ?>

<?= $this->fetch('script') ?>

    </body>
</html>

<!-- bootstrap-daterangepicker -->
<script>
//Date picker
    $('#datepicker').datepicker({
        autoclose: true
    });
</script>
<script language="javascript" type="text/javascript">

    var doc = new jsPDF();
    var specialElementHandlers = {
        '#editor': function (element, renderer) {
            return true;
        }
    };

    $('#cmd').click(function () { //alert('am called');
        doc.fromHTML($('#transcriptd').html(), 15, 15, {
            'width': 170,
            'elementHandlers': specialElementHandlers
        });
        doc.save('sample-file.pdf');
    });

</script>

<script>
    $(document).ready(function () {
        var handleDataTableButtons = function () {
            if ($("#datatable-buttons").length) {
                $("#datatable-buttons").DataTable({
                    dom: "Bfrtip",
                    buttons: [
                        {
                            extend: "copy",
                            className: "btn-sm"
                        },
                        {
                            extend: "csv",
                            className: "btn-sm"
                        },
                        {
                            extend: "excel",
                            className: "btn-sm"
                        },
                        {
                            extend: "pdfHtml5",
                            className: "btn-sm"
                        },
                        {
                            extend: "print",
                            className: "btn-sm"
                        },
                    ],
                    responsive: true
                });
            }
        };

        TableManageButtons = function () {
            "use strict";
            return {
                init: function () {
                    handleDataTableButtons();
                }
            };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
            keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
            ajax: "js/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });

        $('#datatable-fixed-header').DataTable({
            fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
            'order': [[1, 'asc']],
            'columnDefs': [
                {orderable: false, targets: [0]}
            ]
        });
        $datatable.on('draw.dt', function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-green'
            });
        });

        TableManageButtons.init();
    });
</script>
<!-- /Datatables -->