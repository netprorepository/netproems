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
               
                <td>
                    <?= $this->Html->link(h($trequest->student->fname. ' '.$trequest->student->lname), ['controller'=>'Students','action' => 'viewstudent', $trequest->student->id,$this->Generateurl($trequest->student->fname)],
                            ['class'=>'fa fa-eye','title'=>'view student details']) ?>
             
                </td>
                <td><?= h($trequest->orderdate) ?></td>
                <td><?= h($trequest->institution) ?></td>
                <td><?= h($trequest->status) ?></td>
                <td><?= $trequest->has('continent') ? $trequest->continent->name : '' ?></td>
                <td><?= $trequest->has('country') ? $trequest->country->name : '' ?></td>
                <td><?= $trequest->has('state') ? $trequest->state->name : '' ?></td>
                <td><?= h($trequest->address) ?></td>
                <td><?= $trequest->has('courier') ? $trequest->courier->name : '' ?></td>
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