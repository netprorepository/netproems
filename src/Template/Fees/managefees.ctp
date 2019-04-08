<?php
  $userdata = $this->request->getSession()->read('usersinfo');
  $userrole = $this->request->getSession()->read('usersroles');
?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <div style="padding-bottom: 10px; margin-bottom: 20px;"><?= $this->Html->link(__(' '), ['action' => 'newfee'], ['class' => 'btn-circle btn-lg fa fa-plus float-right', 'title' => 'add new fee'])
?>
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Manage Fees</h1></div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Fee Manager</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>

                        <tr>

                            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Created By') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                        </tr>
                    </thead>


                    <tfoot>
                        <tr>

                            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('Created By') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </tfoot>

                    </thead>
                    <tbody>
                        <?php foreach ($fees as $fee): ?>
                              <tr>

                              <tr>

                                  <td><?= h($fee->name) ?></td>
                                  <td><?= $this->Number->format($fee->amount) ?></td>
                                  <td><?= $fee->has('user') ? $this->Html->link($fee->user->username, ['controller' => 'Users', 'action' => 'view', $fee->user->id]) : '' ?></td>
                                  <td><?= $this->Number->format($fee->status) ?></td>
                                  <td class="actions">
                                      <?= $this->Html->link(__(' View'), ['action' => 'viewfee', $fee->id, $this->Generateurl($fee->name)], ['class' => 'btn btn-round btn-info fa fa-eye', 'title' => 'view fee details'])
                                      ?>
                                      <?= $this->Html->link(__(' Update'), ['action' => 'editfee', $fee->id, $this->Generateurl($fee->name)], ['class' => 'btn btn-round btn-primary fa fa-edit', 'title' => 'update fee'])
                                      ?>
                                      <?php
                                      if ($fee->status ==0) { 
                                         echo $this->Form->postLink(__(' '), ['action' => 'activatefee', $fee->id], ['confirm' => __('Are you sure you want to deactivate this fee # {0}?', $fee->name),
                                              'class' => 'btn btn-round btn-success fa fa-check-circle', 'title' => 'deactivate fee']);
                                      } else {
                                       echo $this->Form->postLink(__(' '), ['action' => 'deactivatefee', $fee->id], ['confirm' => __('Are you sure you want to deactivate this fee # {0}?', $fee->name),
                                              'class' => 'btn btn-round btn-danger fa fa-times-circle', 'title' => 'activate fee']).'&nbsp;';  
                                     echo  $this->Html->link(__(' Allocate'), ['action' => 'allocatefees', $fee->id, $this->Generateurl($fee->name)], ['class' => 'btn btn-round btn-info fa fa-notes', 'title' => 'allocate this fee to departments']);
                                      }
                                      ?>
                                  </td>
                              </tr>
                              
                              </tr>
  <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

