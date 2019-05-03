<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
<!--          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>-->
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">New Admin</h1>
              </div>
    <?= $this->Form->create($admin,['type'=>'file']) ?>
    <fieldset>
        
        <div class="form-group row">
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <?=  $this->Form->control('username', ['label' => 'Username', 'class' => 'form-control form-control-user2',
                        'placeholder'=>'username','type'=>'email']);?>
                      </div>
                    
                     <div class="col-sm-4">
                  <?=$this->Form->control('surname', ['label' =>'Surname', 'class' => 'form-control form-control-user2',
                    'id'=>  'exampleLastName','placeholder'=>'surname'])?>
                    
                  </div>
                    
                      <div class="col-sm-4">
                  <?=$this->Form->control('lastname', ['label' => 'Last Name', 'class' => 'form-control form-control-user2',
                    'id'=>  'exampleLastName','placeholder'=>'last name'])?>
                    
                  </div>
               
                </div>
        <div class="form-group row">
                  <div class="col-sm-4 mb-3 mb-sm-0">
                  <?php $gender = ['Male'=>'Male', 'Female'=>'Female'];  ?>
               

                  <?= $this->Form->control('gender', ['options'=>$gender,'label' => 'Gender', 'class' => 'form-control form-control-user2','placeholder'=>'gender'])?>

               
                      </div>
                    
                     <div class="col-sm-8">
                  <?=$this->Form->control('address', ['label' => 'Address', 'class' => 'form-control form-control-user2',
                    'id'=>  'exampleLastName','placeholder'=>'address'])?>
                    
                  </div>
                    
                     
               
                </div>
         <div class="form-group row">
              <div class="col-sm-4">
                  <?=$this->Form->control('department_id', ['label' => 'Select Department','options'=>$departments, 'class' => 'form-control form-control-user2',
                    'placeholder'=>'department'])?>
                    
                  </div>
                  <div class="col-sm-4 mb-3 mb-sm-0">
                
               

                  <?= $this->Form->control('phone', ['label' =>'Phone', 'class' => 'form-control form-control-user2','placeholder'=>'phone'])?>

               
                      </div>
                    
                     <div class="col-sm-4">
                   <?= $this->Form->control('passports', ['label' => 'Passport', 'type' => 'file', 'class' => 'form-control form-control-user2','placeholder'=>'passport']);?>
              
                    
                  </div>
                    
                   
               
                </div>
        
     
    </fieldset>
     <br /> <br />
                        <?= $this->Form->button('Submit', ['class' => 'btn btn-primary btn-user btn-block']) ?>
                        <?= $this->Form->end() ?>
             
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>


