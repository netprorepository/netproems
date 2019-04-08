<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <!--          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>-->
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Admit New Student</h1>
                        </div>
    <?= $this->Form->create($student) ?>
    <fieldset>
       <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
        <?= $this->Form->control('fname',[ 'label' => 'First Name','placeholder' => 'First Name', 'required',
                                            'class' => 'form-control form-control-user2'])?>
         </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
            <?= $this->Form->control('lname',[ 'label' => 'Last Name','placeholder' => 'Last Name', 'required',
                                            'class' => 'form-control form-control-user2'])?>
                                    
                                 </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">    
            <?= $this->Form->control('mname',[ 'label' => 'Middle Name','placeholder' => 'Middle Name', 
                                            'class' => 'form-control form-control-user2'])?>
                                       </div>
                            </div>
                                    
                                   <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">  
            <?= $this->Form->control('dob',[ 'label' => 'Date Of Birth','placeholder' => 'Date Of Birth', 
                                            'class' => 'form-control form-control-user2'])?>
                                     </div>
                                <div class="col-sm-4 mb-3 mb-sm-0"> 
          
            <?= $this->Form->control('department_id',['options' => $departments,'label'=>'Select Department','empty'=>'Select Departments','class'=>'select2_multiple form-control form-control-user'])?>
                                    </div>
                                    
                       <div class="col-sm-4 mb-3 mb-sm-0">               
            <?= $this->Form->control('olevelresulturl',[ 'label' => 'O\'Level Cert','placeholder' => 'olevel cert', 
                                            'class' => 'form-control form-control-user2','type'=>'file'])?>
                                  </div>
                            </div>
                           
          <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
            <?=$this->Form->control('jamb',[ 'label' => 'Jamb Score','placeholder' => 'Jamb Score', 
                                            'class' => 'form-control form-control-user2','required'])?>
                                    </div>
                                    
                       <div class="col-sm-4 mb-3 mb-sm-0">
            <?= $this->Form->control('birthcerturl',[ 'label' => 'Birth Cert','placeholder' => 'Birth Cert', 
                                            'class' => 'form-control form-control-user2','required','type'=>'file'])?>
                            </div>
                                    
              <div class="col-sm-4 mb-3 mb-sm-0">
               <?= $this->Form->control('othercerts',[ 'label' => 'Others','placeholder' => 'Other Cert', 
                                            'class' => 'form-control form-control-user2','required','type'=>'file'])?>
                     
              </div>
               </div>
           <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
            <?= $this->Form->control('email',[ 'label' => 'Email Address','placeholder' => 'Email Address', 
                                            'class' => 'form-control form-control-user2','required','type'=>'email'])?>
                                    </div>
                                    
              <div class="col-sm-4 mb-3 mb-sm-0">
           <?= $this->Form->control('state_id', ['options' => $states,'label'=>'Select State','empty'=>'Select State','class'=>'select2_multiple form-control form-control-user','multiple'=>false])?>
             </div>
                                    
              <div class="col-sm-4 mb-3 mb-sm-0">
                  <?= $this->Form->control('country_id', ['options' => $countries,'label'=>'Select Country','empty'=>'Select Country','class'=>'select2_multiple form-control form-control-user','multiple'=>false])?>
         
            </div>
                                    
              <div class="col-sm-4 mb-3 mb-sm-0">
           <?= $this->Form->control('address',[ 'label' => 'Address','placeholder' => 'Address', 
                                            'class' => 'form-control form-control-user2','required'])?>
                                    </div></div>
           <?php echo $this->Form->control('phone');
            echo $this->Form->control('fathersname');
            echo $this->Form->control('mothersname');
            echo $this->Form->control('fatherphone');
            echo $this->Form->control('motherphone');
            echo $this->Form->control('fathersjob');
            echo $this->Form->control('mothersjob');
            echo $this->Form->control('passporturl');
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('regno');
            echo $this->Form->control('fees._ids', ['options' => $fees]);
            echo $this->Form->control('subjects._ids', ['options' => $subjects]);
        ?>
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