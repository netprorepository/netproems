<?php
$userdata = $this->request->getSession()->read('usersinfo');
$userrole = $this->request->getSession()->read('usersroles');
?>


<!-- Begin Page Content -->
        <div class="container-fluid">
            <div style="padding-bottom: 10px; margin-bottom: 20px;"><?= $this->Html->link(__(' '), ['action' => 'newfeeallocation'],
                            ['class'=>'btn-circle btn-lg fa fa-plus float-right','title'=>'allocate fees to departments']) ?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Manage Fee Allocations</h1></div>
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Fee Allocation Manager</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
           <tr>
              
                <th scope="col"><?= $this->Paginator->sort('fee') ?></th>
                <th scope="col"><?= $this->Paginator->sort('department(s)') ?></th>
                <th scope="col"><?= $this->Paginator->sort('startdate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('enddate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Allocated By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
                  </thead>
            
            
              <tfoot>
            <tr>
              
                <th scope="col"><?= $this->Paginator->sort('fee') ?></th>
                <th scope="col"><?= $this->Paginator->sort('department(s)') ?></th>
                <th scope="col"><?= $this->Paginator->sort('startdate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('enddate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Allocated By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
              </tfoot>
            
        </thead>
        <tbody>
            <?php foreach ($feeallocations as $feeallocation): ?>
            <tr>
              
                <td><?= $feeallocation->has('fee') ? $this->Html->link($feeallocation->fee->name, ['controller' => 'Fees', 'action' => 'viewfee', $feeallocation->fee->id]) : '' ?></td>
                <td><?= $feeallocation->has('department') ? $this->Html->link($feeallocation->department->name, ['controller' => 'Departments', 'action' => 'viewdepartment', $feeallocation->department->id]) : '' ?></td>
                <td><?= h($feeallocation->startdate) ?></td>
                <td><?= h($feeallocation->enddate) ?></td>
                <td><?= $feeallocation->has('user') ? $this->Html->link($feeallocation->user->username, ['controller' => 'Users', 'action' => 'view', $feeallocation->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__(' View'), ['action' => 'viewfeeallocation', $feeallocation->id]
                            , ['class' => 'btn btn-round btn-info fa fa-eye', 'title' => 'view fee details'])?>
                    <?= $this->Html->link(__(' Edit'), ['action' => 'editfeeallocation', $feeallocation->id]
                            , ['class' => 'btn btn-round btn-primary fa fa-edit', 'title' => 'update fee allocation']) ?>
                    <?= $this->Form->postLink(__(' '), ['action' => 'deactivatefeeallocation', $feeallocation->id],
                            ['confirm' => __('Are you sure you want to delete # {0}?', $feeallocation->id),
                                'class' => 'btn btn-round btn-danger fa fa-times-circle', 'title' => 'delete fee allocation']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
