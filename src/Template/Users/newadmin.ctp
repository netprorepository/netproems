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
                  <?= $this->Form->create($user,['type'=>'file','class'=>'user']) ?>
            
                <div class="form-group row">
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <?=  $this->Form->control('username', ['label' => false, 'class' => 'form-control form-control-user',
                        'placeholder'=>'username','type'=>'email']);?>
                      </div>
                    
                     <div class="col-sm-4">
                  <?=$this->Form->control('password', ['label' => false, 'class' => 'form-control form-control-user',
                    'id'=>  'exampleLastName','placeholder'=>'password','type'=>'password'])?>
                    
                  </div>
                    
                      <div class="col-sm-4">
                  <?=$this->Form->control('cpassowrd', ['label' => false, 'class' => 'form-control form-control-user',
                    'id'=>  'exampleLastName','placeholder'=>'confirm password','type'=>'password'])?>
                    
                  </div>
               
                </div>
                
                  <div class="form-group row">
                           
                  <div class="col-sm-6">
                  <?=$this->Form->control('fname', ['label' => false, 'class' => 'form-control form-control-user',
                    'id'=>  'exampleLastName','placeholder'=>'First Name'])?>
                    
                  </div>
                 
                  <div class="col-sm-6">
                   <?=$this->Form->control('lname', ['label' => false, 'class' => 'form-control form-control-user','id'=>'exampleFirstName',
                     'placeholder'=>'Last Name'  ])?>
               
                  </div>
           
                </div>
              
                <div class="form-group row">
                      <div class="col-sm-6">
                  <?= $this->Form->control('role_id', ['options' => $roles, 'label' => false, 'class' => 'form-control','placeholder'=>'role','required'])?>
               
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
              <?= $this->Form->control('mname', ['label' => false, 'class' => 'form-control form-control-user','placeholder'=>'middle name'])?>
                    </div>
                 
                </div>
                
                 <div class="form-group row">
                      <div class="col-sm-6">
                          <?php $gender = ['Male'=>'Male', 'Female'=>'Female'];  ?>
                  <?= $this->Form->control('gender', ['label'=>false,'options' => $gender, 'class' => 'form-control','placeholder'=>'gender'])?>
               
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
              <?= $this->Form->control('dob', ['label' => false, 'class' => 'form-control form-control-user', 'type' => 'text', 'id' => 'datepicker','placeholder'=>'date of birth'])?>
                    </div>
                  
                </div>
                
                
                  <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
              <?= $this->Form->control('country_id', ['label' => false, 'class' => 'form-control','placeholder'=>'country'])?>
                    </div>
                  <div class="col-sm-6">
                  <?= $this->Form->control('state_id', ['label' => false, 'class' => 'form-control','placeholder'=>'state']);?>
               
                  </div>
                </div>
                
                
                 <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
              <?= $this->Form->control('phone', ['label' =>false, 'class' => 'form-control form-control-user','placeholder'=>'phone'])?>
                    </div>
                     
                     <div class="col-sm-6">
                  <?= $this->Form->control('address', ['label' => false, 'class' => 'form-control form-control-user','placeholder'=>'address','required'])?>
               
                  </div>
                  
                </div>
                
                
                  <div class="form-group row">
                      <div class="col-sm-6">
                  <?= $this->Form->control('department_id', ['options' => $departments, 'label' => false, 'class' => 'form-control','placeholder'=>'department'])?>
               
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
              <?= $this->Form->control('passports', ['label' => false, 'type' => 'file', 'class' => 'form-control form-control-user','placeholder'=>'passport']);?>
                    </div>
                  
                </div>
                
                
                <div class="form-group">
        <?= $this->Form->control('profile', ['label' => false, 'rows' => 6, 'colunm' => 6, 'required', 'class' => 'form-control','placeholder'=>'profile'])?>
               
                </div>
                
            
              <br /> <br />
                        <?= $this->Form->button('Submit', ['class' => 'btn btn-primary btn-user btn-block']) ?>
                        <?= $this->Form->end() ?>
             
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>



