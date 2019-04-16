<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <!--          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>-->
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Update Profile</h1>
                        </div>
                        <?= $this->Form->create($student, ['type' => 'file']) ?>
                        <fieldset>
                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?=
                                      $this->Form->control('fname', ['label' => 'First Name', 'placeholder' => 'First Name', 'required',
                                          'class' => 'form-control form-control-user2'])
                                    ?>
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?=
                                      $this->Form->control('lname', ['label' => 'Last Name', 'placeholder' => 'Last Name', 'required',
                                          'class' => 'form-control form-control-user2'])
                                    ?>

                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">    
                                    <?=
                                      $this->Form->control('mname', ['label' => 'Middle Name', 'placeholder' => 'Middle Name',
                                          'class' => 'form-control form-control-user2'])
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">  
<?=
  $this->Form->control('dob', ['label' => 'Date Of Birth', 'placeholder' => 'Date Of Birth',
      'class' => 'form-control form-control-user2', 'type' => 'text', 'id' => 'datepicker'])
?>
                                </div>

                                <div class="col-sm-6 mb-3 mb-sm-0">
<?=
  $this->Form->control('passporturls', ['label' => 'Upload Passport', 'placeholder' => 'Uplaod Passport',
      'class' => 'form-control form-control-user2', 'type' => 'file'])
?>
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?=
                                      $this->Form->control('email', ['label' => 'Email Address', 'placeholder' => 'Email Address',
                                          'class' => 'form-control form-control-user2', 'required', 'type' => 'email', 'disabled'])
                                    ?>
                                </div>

                                <div class="col-sm-4 mb-3 mb-sm-0">
<?= $this->Form->control('country_id', ['options' => $countries, 'label' => 'Select Country', 'empty' => 'Select Country', 'class' => 'select2_multiple form-control form-control-user2', 'multiple' => false, 'onChange'=>'getstates(this.value)']) ?>

                                </div>

                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?= $this->Form->control('state_id', ['options' => $states, 'label' => 'Select State', 'empty' => 'Select State', 'class' => 'form-control form-control-user', 'multiple' => false, 'id'=>'states1']) ?>
                                </div>

                            </div>

                            <div class="form-group row">        
                                <div class="col-sm-8 mb-3 mb-sm-0">
                                    <?=
                                      $this->Form->control('address', ['label' => 'Address', 'placeholder' => 'Address',
                                          'class' => 'form-control form-control-user2', 'required'])
                                    ?>
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?php
                                      echo $this->Form->control('phone', ['label' => 'Phone', 'placeholder' => 'Phone',
                                          'class' => 'form-control form-control-user2', 'required'])
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row">        
                                <div class="col-sm-6 mb-3 mb-sm-0">
<?=
  $this->Form->control('fathersname', ['label' => 'Father\'s Name', 'placeholder' => 'Father Name',
      'class' => 'form-control form-control-user2', 'required'])
?>
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <?=
                                      $this->Form->control('mothersname', ['label' => 'Mother\'s Name', 'placeholder' => 'Mother Name',
                                          'class' => 'form-control form-control-user2', 'required'])
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row">        
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?=
                                      $this->Form->control('fatherphone', ['label' => 'Father\'s Phone', 'placeholder' => 'Father Phone',
                                          'class' => 'form-control form-control-user2', 'required'])
                                    ?>
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
<?=
  $this->Form->control('motherphone', ['label' => 'Mother\'s Phone', 'placeholder' => 'Mother Phone',
      'class' => 'form-control form-control-user2', 'required'])
?>
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
<?=
  $this->Form->control('fathersjob', ['label' => 'Father\'s Occupation', 'placeholder' => 'Father Occupation',
      'class' => 'form-control form-control-user2', 'required'])
?>
                                </div>

                            </div>

                            <div class="form-group row">        
                                <div class="col-sm-6 mb-3 mb-sm-0">
<?=
  $this->Form->control('mothersjob', ['label' => 'Mother\'s Occupation', 'placeholder' => 'Mother Occupation',
      'class' => 'form-control form-control-user2', 'required'])
?>
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
<script>
    
        function getstates(stateid){ 

    $.ajax({
        url: '../Students/getstates/'+stateid,
        method: 'GET',
        dataType: 'text',
        success: function(response) {
           // console.log(response);
            document.getElementById('states1').innerHTML = "";
            document.getElementById('states1').innerHTML = response;
            //location.href = redirect;
        }
    });

}
    </script>