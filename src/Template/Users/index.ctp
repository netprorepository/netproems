<div class="right_col" role="main" style="margin-bottom: 55px;">
  <div class="">
  		<div class="page-title">
          <div class="title_left">
            <h3><small></small></h3>
          </div>
        </div>
        <div class="clearfix"></div>
         <div class="row">
          <div class="col-md-12">
            <div class="x_panel">
            	<div class="x_title">
	                <h2>Manage Users</h2>
	                <ul class="nav navbar-right panel_toolbox">
	                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	                  </li>
	                  </li>
	                </ul>
	                <div class="clearfix"></div>
	            </div>
	            <div class="x_content">
                        	<div class="col-md-12 col-sm-9 col-xs-12">
		            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%"
		            style="margin-top: 23px;"><?= $this->Flash->render() ?>
		              <thead>
		                <tr>
		                  
		                 
		                  <th>UNIQUID</th>
                                   <th>USERNAME</th>
		                  <th>PHONE</th>
                                  <th>DEPT</th>
                                   <th>ROLE</th>
                                  
		                  <th>ACTIONS</th>
		                </tr>
		              </thead>
		               <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
             
                              
             
                <td><?= h($user->useruniquid) ?></td>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->phone) ?></td>
                <td><?=  $user->department->name ?>
                  <td><?= h($user->role->role_name) ?></td>
                
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'viewadmin', $user->id],['class'=>'btn btn-round btn-success']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'updateadmin', $user->id],['class'=>'btn btn-round btn-info']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'deactivateadmin', $user->id], ['confirm' => __('Are you sure you want to delete this request # {0}?', $user->id),'class'=>'btn btn-round btn-danger']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
            		</table>
	            	</div>
                         </div>
            </div>
          </div>
        </div>        
  </div>
</div>

