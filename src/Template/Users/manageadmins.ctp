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
                        <th> NAME</th>
                       <th>ROLE</th>
                       <th>USERNAME</th>
                       <th>ACTIONS</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                       <th> NAME</th>
                       <th>ROLE</th>
                       <th>USERNAME</th>
                       <th>ACTIONS</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      <?php foreach ($admins as $admin): ?>
                                        <tr>

                                            <td><?= h($admin->fname . ' ' . $admin->lname) ?></td>
                                            <td><?= h($admin->role->role_name) ?></td>
                                            <td><?= $admin->username ?></td>


                                            <td class="actions">
                                                <?= $this->Html->link(__('View'), ['action' => 'viewadmin', $admin->id, $this->GenerateUrl($admin->fname)], ['class'=>'btn btn-round btn-info fa fa-eye']) ?>
                                                <?= $this->Html->link(__('Edit'), ['action' => 'updateadmin', $admin->id, $this->GenerateUrl($admin->fname)], ['class'=>'btn btn-round btn-primary fa fa-edit']) ?>
                                                <?php if ($admin->userstatus == "Enabled"){
							echo $this->Form->postLink(__('Disable'), ['action' => 'changeuserstatus', $admin->id,'Disabled'], ['confirm' => __('Are you sure you want disable user # {0}?', $admin->fname),'class'=>'btn btn-round btn-danger']);
													
                                                    } else{
                                                        echo $this->Form->postLink(__('Enable'), ['action' => 'changeuserstatus', $admin->id,'Enabled'], ['confirm' => __('Are you sure you want to enable # {0}?', $admin->fname),'class'=>'btn btn-round btn-success']); 
                                                    
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
        <!-- /.container-fluid -->


