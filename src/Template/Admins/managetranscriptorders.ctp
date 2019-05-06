<?php
$userdata = $this->request->getSession()->read('usersinfo');
$userrole = $this->request->getSession()->read('usersroles');
?>


<!-- Begin Page Content -->
        <div class="container-fluid">
            <div style="padding-bottom: 10px; margin-bottom: 20px;"><?= $this->Html->link(__(' '), ['action' => 'newstudent'],
                            ['class'=>'btn-circle btn-lg fa fa-plus float-right','title'=>'addmit new student']) ?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Manage Students</h1></div>
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Student Manager</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
            <tr>
                
                <th scope="col"><?= $this->Paginator->sort('Student') ?></th>
                <th scope="col"><?= $this->Paginator->sort('orderdate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('institution') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('continent') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('courier') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                
                <th scope="col"><?= $this->Paginator->sort('Student') ?></th>
                <th scope="col"><?= $this->Paginator->sort('orderdate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('institution') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('continent') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('courier') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($trequests as $trequest): ?>
            <tr>
               
                <td><?= $trequest->has('student') ? $this->Html->link($trequest->student->fname, ['controller' => 'Students', 'action' => 'view', $trequest->student->id]) : '' ?></td>
                <td><?= h($trequest->orderdate) ?></td>
                <td><?= h($trequest->institution) ?></td>
                <td><?= h($trequest->status) ?></td>
                <td><?= $trequest->has('continent') ? $this->Html->link($trequest->continent->name, ['controller' => 'Continents', 'action' => 'view', $trequest->continent->id]) : '' ?></td>
                <td><?= $trequest->has('country') ? $this->Html->link($trequest->country->name, ['controller' => 'Countries', 'action' => 'view', $trequest->country->id]) : '' ?></td>
                <td><?= $trequest->has('state') ? $this->Html->link($trequest->state->name, ['controller' => 'States', 'action' => 'view', $trequest->state->id]) : '' ?></td>
                <td><?= h($trequest->address) ?></td>
                <td><?= $trequest->has('courier') ? $this->Html->link($trequest->courier->name, ['controller' => 'Couriers', 'action' => 'view', $trequest->courier->id]) : '' ?></td>
                <td><?= h($trequest->amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $trequest->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $trequest->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $trequest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $trequest->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
         </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>