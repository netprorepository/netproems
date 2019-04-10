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
	                <h2>Update Topic</h2>
	                <ul class="nav navbar-right panel_toolbox">
	                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	                  </li>
	                  </li>
	                </ul>
	                <div class="clearfix"></div>
	            </div>
	            <div class="x_content">
      <?= $this->Flash->render() ?>
    <?= $this->Form->create($topic) ?>
    <fieldset>
<!--        <legend><?= __('Add Topic') ?></legend>-->
        <?php
           echo '<div class="col-md-6">';
            echo $this->Form->control('subject_id', ['options' => $subjects,'class'=>'select2_multiple form-control']);
               echo '</div>';
                echo '<div class="col-md-6">';
                echo $this->Form->control('title',['label'=>'Topic Title', 'class'=>'form-control']);
                 echo '</div>';
                
               echo '<div class="col-md-12">';
            echo $this->Form->control('contents',['label'=>'Description', 'class'=>'form-control','type'=>'textarea','class'=>'summernote']);
              echo '</div>';
           // echo $this->Form->control('admin_id', ['options' => $admins]);
           // echo $this->Form->control('uploaddate');
           // echo $this->Form->control('updatedon');
           // echo $this->Form->control('title');
        ?>
    </fieldset>
    <br />
    <?= $this->Form->button('Update',['class'=>'btn btn-primary pull-right']) ?>
    <?= $this->Form->end() ?>
 </div>
                         </div>
            </div>
          </div>
        </div>        
  </div>
