<?php
$userdata = $this->request->getSession()->read('usersinfo');
$userrole = $this->request->getSession()->read('usersroles');
?>


<!-- Begin Page Content -->
        <div class="container-fluid">
            <div style="padding-bottom: 10px; margin-bottom: 20px;"><?= $this->Html->link(__(' '), ['action' => 'newadmin'],
                            ['class'=>'btn-circle btn-lg fa fa-plus float-right','title'=>'add new admin']) ?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Manage Admins</h1></div>
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Admin Manager</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
            <tr>
              
                <th >Username</th>
                <th > Name</th>
                <th >Status</th>
                <th > Date_Added</th>
                <th >Photo</th>
                <th > Gender</th>
                <th >Department</th>
                <th>Phone</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tfoot>
             <tr>
              
                <th >Username</th>
                <th > Name</th>
                <th >Status</th>
                <th > Date_Added</th>
                <th >Photo</th>
                <th > Gender</th>
                <th >Department</th>
                <th>Phone</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($admins as $admin): ?>
            <tr>
                
                <td><?= $admin->has('user') ? $admin->user->username : '' ?></td>
                <td><?= h($admin->surname.' '.$admin->lastname) ?></td>
               
                <td><?= h($admin->status) ?></td>
                <td><?= h(date('d M Y', strtotime($admin->date_created))) ?></td>
                <td>
                   <?= $this->Html->image($admin->adminphoto, ['alt' => 'admin', 'class' => 'img-responsive', 'style'=>'height: 50px; width: 50px;'])?>
                   </td>
                <td><?= h($admin->gender) ?></td>
                <td><?= $admin->has('department') ? $admin->department->name : '' ?></td>
                <td><?= h($admin->phone) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__(' Viewadmin'), ['action' => 'view', $admin->id,$admin->lastname],['class'=>'btn btn-round btn-primary fa fa-eye']) ?>
                    
                    <?php if ($admin->status == "active"){
							echo $this->Form->postLink(__('Deactivate'), ['action' => 'deactivate', $admin->id], ['confirm' => __('Are you sure you want deactivate # {0}?', $admin->surname),'class'=>'btn btn-round btn-danger']);
													
                                                    } else{
                                                        echo $this->Form->postLink(__('Activate'), ['action' => 'activate', $admin->id], ['confirm' => __('Are you sure you want to activate # {0}?', $admin->surname),'class'=>'btn btn-round btn-success']); 
                                                    
							} ?>
                   
                        </td>
            </tr>
            <?php endforeach; ?>
       </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
