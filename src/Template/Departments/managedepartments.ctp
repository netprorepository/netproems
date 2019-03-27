<?php
$userdata = $this->request->getSession()->read('usersinfo');
$userrole = $this->request->getSession()->read('usersroles');
?>


<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Manage Admins</h1>

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
          
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
              
                <th scope="col"><?= $this->Paginator->sort('faculty') ?></th>
                <th scope="col"><?= $this->Paginator->sort('deptcode') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            
            
              <tfoot>
            <tr>
          
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
              
                <th scope="col"><?= $this->Paginator->sort('faculty') ?></th>
                <th scope="col"><?= $this->Paginator->sort('deptcode') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
              </tfoot>
            
        </thead>
        <tbody>
            <?php foreach ($departments as $department): ?>
            <tr>
               
                <td><?= h($department->name) ?></td>
                <td><?= h($department->description) ?></td>
              
                <td><?= $department->has('faculty') ? $this->Html->link($department->faculty->name, ['controller' => 'Faculties', 'action' => 'view', $department->faculty->id]) : '' ?></td>
                <td><?= h($department->deptcode) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $department->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $department->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $department->id], ['confirm' => __('Are you sure you want to delete # {0}?', $department->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
         </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
<!--    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>-->

