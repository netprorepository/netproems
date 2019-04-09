<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <!--          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>-->
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">View/Update Applicant</h1>
                        </div>
                        <?= $this->Form->create($student,['type'=>'file']) ?>
                        <fieldset>
                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?= $this->Form->control('fname', ['label' => 'First Name', 'placeholder' => 'First Name', 'required',
                                          'class' => 'form-control form-control-user2','disabled'])
                                    ?>
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?= $this->Form->control('lname', ['label' => 'Last Name', 'placeholder' => 'Last Name', 'required',
                                          'class' => 'form-control form-control-user2','disabled'])
                                    ?>

                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">    
<?= $this->Form->control('mname', ['label' => 'Middle Name', 'placeholder' => 'Middle Name',
      'class' => 'form-control form-control-user2','disabled'])
?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">  
<?= $this->Form->control('dob', ['label' => 'Date Of Birth', 'placeholder' => 'Date Of Birth',
      'class' => 'form-control form-control-user2','type' => 'text', 'id' => 'datepicker','disabled'])
?>
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0"> 

                                    <?= $this->Form->control('department_id', ['options' => $departments, 'label' => 'Select Department', 'empty' => 'Select Departments', 'class' => 'select2_multiple form-control form-control-user','disabled']) ?>
                                </div>

                                <div class="col-sm-4 mb-3 mb-sm-0">               
<?= $this->Form->control('olevelresulturls', ['label' => 'O\'Level Cert', 'placeholder' => 'olevel cert',
      'class' => 'form-control form-control-user2', 'type' => 'file','disabled'])
?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?= $this->Form->control('jamb', ['label' => 'Jamb Score', 'placeholder' => 'Jamb Score',
                                          'class' => 'form-control form-control-user2','disabled'])
                                    ?>
                                </div>

                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?= $this->Form->control('birthcerturls', ['label' => 'Birth Cert', 'placeholder' => 'Birth Cert',
                                          'class' => 'form-control form-control-user2', 'type' => 'file','disabled'])
                                    ?>
                                </div>

                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?= $this->Form->control('othercertss', ['label' => 'Others', 'placeholder' => 'Other Cert',
                                          'class' => 'form-control form-control-user2', 'type' => 'file','disabled'])
                                    ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?= $this->Form->control('email', ['label' => 'Email Address', 'placeholder' => 'Email Address',
                                          'class' => 'form-control form-control-user2', 'required', 'type' => 'email','disabled'])
                                    ?>
                                </div>
                                
                                  <div class="col-sm-4 mb-3 mb-sm-0">
<?= $this->Form->control('country_id', ['options' => $countries, 'label' => 'Select Country', 'empty' => 'Select Country', 'class' => 'select2_multiple form-control form-control-user', 'multiple' => false,'disabled']) ?>

                                </div>

                                <div class="col-sm-4 mb-3 mb-sm-0">
<?= $this->Form->control('state_id', ['options' => $states, 'label' => 'Select State', 'empty' => 'Select State', 'class' => 'select2_multiple form-control form-control-user', 'multiple' => false,'disabled']) ?>
                                </div>
 
                            </div>

                            <div class="form-group row">        
                                <div class="col-sm-8 mb-3 mb-sm-0">
<?= $this->Form->control('address', ['label' => 'Address', 'placeholder' => 'Address',
      'class' => 'form-control form-control-user2', 'required','disabled'])
?>
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?php echo $this->Form->control('phone', ['label' => 'Phone', 'placeholder' => 'Phone',
                                          'class' => 'form-control form-control-user2', 'required','disabled'])
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row">        
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <?= $this->Form->control('fathersname', ['label' => 'Father\'s Name', 'placeholder' => 'Father Name',
                                          'class' => 'form-control form-control-user2', 'required','disabled'])
                                    ?>
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <?= $this->Form->control('mothersname', ['label' => 'Mother\'s Name', 'placeholder' => 'Mother Name',
                                          'class' => 'form-control form-control-user2', 'required','disabled'])
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row">        
                                <div class="col-sm-4 mb-3 mb-sm-0">
<?= $this->Form->control('fatherphone', ['label' => 'Father\'s Phone', 'placeholder' => 'Father Phone',
      'class' => 'form-control form-control-user2', 'required','disabled'])
?>
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
<?= $this->Form->control('motherphone', ['label' => 'Mother\'s Phone', 'placeholder' => 'Mother Phone',
      'class' => 'form-control form-control-user2', 'required','disabled'])
?>
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?= $this->Form->control('fathersjob', ['label' => 'Father\'s Occupation', 'placeholder' => 'Father Occupation',
                                          'class' => 'form-control form-control-user2', 'required','disabled'])
                                    ?>
                                </div>

                            </div>

                            <div class="form-group row">        
                                <div class="col-sm-6 mb-3 mb-sm-0">
<?= $this->Form->control('mothersjob', ['label' => 'Mother\'s Occupation', 'placeholder' => 'Mother Occupation',
      'class' => 'form-control form-control-user2', 'required','disabled'])
?>
                                </div>
                                <div class="col-sm-3 mb-3 mb-sm-0">
<?= $this->Form->control('passporturls', ['label' => 'Upload Passport', 'placeholder' => 'Uplaod Passport',
      'class' => 'form-control form-control-user2', 'type' => 'file','disabled'])
?>
                                </div>
                                <div class="col-sm-3 mb-3 mb-sm-0">
<?= $this->Form->control('fees._ids', ['options' => $fees, 'label' => 'Select Fees', 'empty' => 'Select Fees', 'class' => 'select2_multiple form-control form-control-user', 'required']) ?>
                                </div>

                            </div>   

                            <div class="form-group row">        
                                <div class="col-sm-6 mb-3 mb-sm-0">
<?= $this->Form->control('subjects._ids', ['options' => $subjects, 'label' => 'Select Subjects', 'empty' => 'Select Subjects', 'class' => 'select2_multiple form-control form-control-user', 'required']) ?> 
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                   <?php $status = ['Selected'=>'Selected','Pending'=>'Pending','Rejected'=>'Rejected'];
                                           echo $this->Form->control('status',['options'=>$status,'label'=>'Change Status','empty' => 'Select Status','class' => 'form-control form-control-user', 'required']);?>  
                                    
                                </div> 
                                
                                
                            </div>


                            <!--   echo $this->Form->control('user_id', ['options' => $users]);
                               echo $this->Form->control('regno');
                             
                            -->


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
