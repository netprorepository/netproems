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
	                <h2>Create New Admin</h2>
	                <ul class="nav navbar-right panel_toolbox">
	                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	                  </li>
	                  </li>
	                </ul>
	                <div class="clearfix"></div>
	            </div>
	            <div class="x_content">
      
        <?= $this->Form->create($user ,['type'=>'file']) ?>
    <fieldset>
       
        <?php
        echo '<div class="col-md-4">';
            echo $this->Form->control('username', ['label'=>'USERNAME','class'=>'form-control']);
            echo '</div>';
            
             echo '<div class="col-md-4">';
            echo $this->Form->control('password', ['label'=>'PASSWORD','class'=>'form-control']);
             echo '</div>';
             
            echo '<div class="col-md-4">'; 
            echo $this->Form->control('fname', ['label'=>'FIRST NAME','class'=>'form-control']);
             echo '</div>';
             
               echo '<div class="col-md-4">'; 
            echo $this->Form->control('lname', ['label'=>'LAST NAME','class'=>'form-control']);
             echo '</div>';
             
               echo '<div class="col-md-4">'; 
            echo $this->Form->control('mname', ['label'=>'MIDDLE NAME','class'=>'form-control']);
             echo '</div>';
             
               echo '<div class="col-md-4">';
            echo $this->Form->control('gender', ['label'=>'GENDER','class'=>'form-control']);
             echo '</div>';
             
               echo '<div class="col-md-4">';
            echo $this->Form->control('dob',  ['label'=>'DATE OF BIRTH','class'=>'form-control','type'=>'text','id'=>'datepicker']);
            echo '</div>';
            
              echo '<div class="col-md-4">';
            echo $this->Form->control('address', ['label'=>'ADDRESS','class'=>'form-control']);
             echo '</div>';
             
              echo '<div class="col-md-4">';
            echo $this->Form->control('country_id', ['label'=>'HOME COUNTRY','class'=>'form-control']);
               echo '</div>';
               
                 echo '<div class="col-md-4">';
            echo $this->Form->control('state_id', ['label'=>'STATE','class'=>'form-control']);
             echo '</div>';
               
             echo '<div class="col-md-4">';   
            echo $this->Form->control('phone', ['label'=>'PHONE','class'=>'form-control']);
             echo '</div>';
          
              echo '<div class="col-md-4">';
            echo $this->Form->control('department_id', ['options' => $departments,'label'=>'DEPARTMENT','class'=>'form-control']);
           echo '</div>';
           
       
        echo '<div class="col-md-12">';
        echo $this->Form->control('profile',['label'=>'PROFILE','rows'=>6,'colunm'=>6, 'required','class'=>'form-control']);
         echo '</div>';
         
           echo '<div class="col-md-4">';
            
            echo $this->Form->control('role_id', ['options' => $roles,'label'=>'ROLE','class'=>'form-control']);
       echo '</div>';
      
          echo '<div class="col-md-4">';
         echo $this->Form->control('passport',['label'=>'PASSPORT','type'=>'file','class'=>'form-control']);
          echo '</div>';
//           echo '<div class="col-md-4">';
//            echo $this->Form->control('useruniquid',['label'=>'UNIQUE ID','class'=>'form-control','disabled']);
//                      echo '</div>';
       
            ?>

    </fieldset>
                  <br /> <br />
   <?= $this->Form->button('Submit',['class'=>'btn btn-primary pull-right']) ?>
    <?= $this->Form->end() ?>
                        
                        </div>
                         </div>
            </div>
          </div>
        </div>        
  </div>
</div>

