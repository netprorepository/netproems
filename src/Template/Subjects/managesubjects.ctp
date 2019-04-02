<?php
$userdata = $this->request->getSession()->read('usersinfo');
$userrole = $this->request->getSession()->read('usersroles');
?>


<!-- Begin Page Content -->
        <div class="container-fluid">
          <div style="padding-bottom: 10px; margin-bottom: 20px;"><?= $this->Html->link(__(' '), ['action' => 'add'],
                            ['class'=>'btn-circle btn-lg fa fa-plus float-right','title'=>'add new Subject']) ?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Manage Subject</h1></div>
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Subject Manager</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
            <tr>
          
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('credit') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
               
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
                  </thead>
            
            
              <tfoot>
            <tr>
          
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('credit') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
              
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
              </tfoot>
            
        </thead>
        <tbody>
            <?php foreach ($subjects as $subjects): ?>
            <tr>
               
                
                <td><?= h($subjects->name) ?></td>
                <td><?= h($subjects->subjectcode) ?></td>
                <td><?= h($subjects->creditload) ?></td>
                <td><?= h($subjects->created_date) ?></td>
                       
                <td class="actions">
                    <?= $this->Html->link(__(' View'), ['action' => 'view', $subjects->id,$this->Generateurl($subjects->name)],
                            ['class'=>'btn btn-round btn-info fa fa-eye','title'=>'view subject details']) ?>
                    <?= $this->Html->link(__(' Update'), ['action' => 'edit', $subjects->id,$subjects->name],
                            ['class'=>'btn btn-round btn-primary fa fa-edit','title'=>'update department details']) ?>
                    <?php if ($subjects->status == "1")
                        {
                            echo $this->Form->postLink(__('Disable'), ['action' => 'changeuserstatus', $subjects->id, 0 ], ['confirm' => __('Are you sure you want disable {0}?', $subjects->name),'class'=>'btn btn-round btn-danger']);
													
                        } else{
                            echo $this->Form->postLink(__('Enable'), ['action' => 'changeuserstatus', $subjects->id, 1 ], ['confirm' => __('Are you sure you want to enable {0}?', $subjects->name),'class'=>'btn btn-round btn-success']); 
                                                    
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

