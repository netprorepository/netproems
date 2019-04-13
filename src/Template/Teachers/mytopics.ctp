<?php
$userdata = $this->request->getSession()->read('usersinfo');
$userrole = $this->request->getSession()->read('usersroles');
?>
<!-- Begin Page Content -->
        <div class="container-fluid">

         <div style="padding-bottom: 10px; margin-bottom: 20px;">
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Manage Topics</h1></div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Topic Manager</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
              
                        <th >Subject</th>
                        <th>Topic</th>
                      <th>Actions</th>
            </tr>
        </thead>
        <tfoot>
                 <tr>
              
                        <th >Subject</th>
                        <th>Topic</th>
                   
                        <th>Actions</th>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($mytopics as $topic){  ?>
            <tr>
              
                <td><?= $topic->has('subject') ? $this->Html->link($topic->subject->name, ['controller' => 'Subjects', 'action' => 'view', $topic->subject->id]) : '' ?></td>
               <td><?= h($topic->title) ?></td>
             <td class="actions">
                    <?= $this->Html->link(__(' '), ['action' => 'viewcontents', $topic->id,$this->GenerateUrl($topic->title)],['class'=>'btn btn-info fa fa-eye','title'=>'view topics']) ?>
                    <?= $this->Html->link(__(' '), ['action' => 'edittopic', $topic->id,$this->GenerateUrl($topic->title)],['class'=>'btn btn-primary fa fa-edit','title'=>'update topic']) ?>
                    <?= $this->Form->postLink(__(' '), ['action' => 'delete', $topic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $topic->title),'class'=>'fa fa-times btn btn-danger']) ?>
                </td>
            </tr>
            <?php } ?>
               
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
