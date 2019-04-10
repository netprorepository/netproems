<?php
$userdata = $this->request->getSession()->read('usersinfo');
$userrole = $this->request->getSession()->read('usersroles');
?>
<!-- Begin Page Content -->
        <div class="container-fluid">

         <div style="padding-bottom: 10px; margin-bottom: 20px;">
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">My Courses</h1></div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Assigned Courses</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th> NAME</th>
                       <th>CODE</th>
                       <th>CREDIT UNIT</th>
                      
                       <th>ACTIONS</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                       <th> NAME</th>
                       <th>CODE</th>
                       <th>CREDIT UNIT</th>
                       
                       <th>ACTIONS</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      <?php foreach ($teacher->subjects as $subjects): ?>
                                        <tr>

                                            <td><?= h($subjects->name) ?></td>
                                            <td><?= h($subjects->subjectcode) ?></td>
                                            <td><?= $subjects->creditload ?></td>
                                            


                                            <td class="actions">
                                                <?= $this->Html->link(__(' '), ['controller'=>'Subjects','action' => 'view', $subjects->id, $this->GenerateUrl($subjects->name)], ['class'=>'btn btn-round btn-info fa fa-eye','title'=>'view subject']) ?>
                                                <?= $this->Html->link(__(' '), ['controller'=>'Topics','action' => 'edittopic', $subjects->id, $this->GenerateUrl($subjects->name)], ['class'=>'btn btn-round btn-primary fa fa-edit']) ?>
                                              <?= $this->Html->link(__('Add Contaent'), ['controller'=>'Teachers','action' => 'addtopic', $subjects->id, $this->GenerateUrl($subjects->name)], ['class'=>'btn btn-round btn-success fa fa-eye','title'=>'add course contents']) ?> 
                                                 <?= $this->Html->link(__('View Contaents'), ['controller'=>'Topics','action' => 'viewcontents', $subjects->id, $this->GenerateUrl($subjects->name)], ['class'=>'btn btn-round btn-info fa fa-eye','title'=>'view contents']) ?> 
										
												 
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



