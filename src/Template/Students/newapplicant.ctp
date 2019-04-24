<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <br />
                 
                <!--          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>-->
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="col-auto">
                            <button class="btn btn-info float-right" title="click to check your application status"
                                    data-toggle="modal" data-target="#myModal" >Check Application Status</button>
                 </div>
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Application Form</h1>
                        </div>
                        <?= $this->Form->create($student,['type'=>'file']) ?>
                        <fieldset>
                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?= $this->Form->control('fname', ['label' => 'First Name', 'placeholder' => 'First Name', 'required',
                                          'class' => 'form-control form-control-user2'])
                                    ?>
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?= $this->Form->control('lname', ['label' => 'Last Name', 'placeholder' => 'Last Name', 'required',
                                          'class' => 'form-control form-control-user2'])
                                    ?>

                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">    
<?= $this->Form->control('mname', ['label' => 'Middle Name', 'placeholder' => 'Middle Name',
      'class' => 'form-control form-control-user2'])
?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">  
<?= $this->Form->control('dob', ['label' => 'Date Of Birth', 'placeholder' => 'Date Of Birth',
      'class' => 'form-control form-control-user2','type' => 'text', 'id' => 'datepicker'])
?>
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0"> 

                                    <?= $this->Form->control('department_id', ['options' => $departments, 'label' => 'Select Department', 'empty' => 'Select Departments', 'class' => 'select2_multiple form-control form-control-user']) ?>
                                </div>

                                <div class="col-sm-4 mb-3 mb-sm-0">               
<?= $this->Form->control('olevelresulturls', ['label' => 'O\'Level Cert', 'placeholder' => 'olevel cert',
      'class' => 'form-control form-control-user2', 'type' => 'file'])
?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?= $this->Form->control('jamb', ['label' => 'Jamb Score', 'placeholder' => 'Jamb Score',
                                          'class' => 'form-control form-control-user2', 'required'])
                                    ?>
                                </div>

                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?= $this->Form->control('birthcerturls', ['label' => 'Birth Cert', 'placeholder' => 'Birth Cert',
                                          'class' => 'form-control form-control-user2', 'required', 'type' => 'file'])
                                    ?>
                                </div>

                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?= $this->Form->control('othercertss', ['label' => 'Others', 'placeholder' => 'Other Cert',
                                          'class' => 'form-control form-control-user2', 'required', 'type' => 'file'])
                                    ?>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?= $this->Form->control('email', ['label' => 'Email Address', 'placeholder' => 'Email Address',
                                          'class' => 'form-control form-control-user2', 'required', 'type' => 'email'])
                                    ?>
                                </div>
                                
                                 <div class="col-sm-4 mb-3 mb-sm-0">
<?= $this->Form->control('country_id', ['options' => $countries, 'label' => 'Select Country', 'empty' => 'Select Country', 'class' => 'select2_multiple form-control form-control-user', 'multiple' => false,'onChange'=>'getstates(this.value)']) ?>

                                </div>

                                <div class="col-sm-4 mb-3 mb-sm-0">
<?= $this->Form->control('state_id', ['options' => $states, 'label' => 'Select State', 'empty' => 'Select State', 'class' => 'select2_multiple form-control form-control-user', 'multiple' => false,'id'=>'states1']) ?>
                                </div>
   
                            </div>

                            <div class="form-group row">        
                                <div class="col-sm-8 mb-3 mb-sm-0">
<?= $this->Form->control('address', ['label' => 'Address', 'placeholder' => 'Address',
      'class' => 'form-control form-control-user2', 'required'])
?>
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?php echo $this->Form->control('phone', ['label' => 'Phone', 'placeholder' => 'Phone',
                                          'class' => 'form-control form-control-user2', 'required'])
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row">        
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <?= $this->Form->control('fathersname', ['label' => 'Father\'s Name', 'placeholder' => 'Father Name',
                                          'class' => 'form-control form-control-user2', 'required'])
                                    ?>
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <?= $this->Form->control('mothersname', ['label' => 'Mother\'s Name', 'placeholder' => 'Mother Name',
                                          'class' => 'form-control form-control-user2', 'required'])
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row">        
                                <div class="col-sm-4 mb-3 mb-sm-0">
<?= $this->Form->control('fatherphone', ['label' => 'Father\'s Phone', 'placeholder' => 'Father Phone',
      'class' => 'form-control form-control-user2', 'required'])
?>
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
<?= $this->Form->control('motherphone', ['label' => 'Mother\'s Phone', 'placeholder' => 'Mother Phone',
      'class' => 'form-control form-control-user2', 'required'])
?>
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <?= $this->Form->control('fathersjob', ['label' => 'Father\'s Occupation', 'placeholder' => 'Father Occupation',
                                          'class' => 'form-control form-control-user2', 'required'])
                                    ?>
                                </div>

                            </div>

                            <div class="form-group row">        
                                <div class="col-sm-6 mb-3 mb-sm-0">
<?= $this->Form->control('mothersjob', ['label' => 'Mother\'s Occupation', 'placeholder' => 'Mother Occupation',
      'class' => 'form-control form-control-user2', 'required'])
?>
                                </div>
                                <div class="col-sm-3 mb-3 mb-sm-0">
<?= $this->Form->control('passporturls', ['label' => 'Upload Passport', 'placeholder' => 'Uplaod Passport',
      'class' => 'form-control form-control-user2', 'type' => 'file'])
?>
                                </div>
                      
                            </div>   
       </fieldset>
                        <br /> <br />
<?= $this->Form->button('Apply', ['class' => 'btn btn-primary btn-user btn-block']) ?>
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
    
    <!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg bg-info">
          <h4 class="modal-title" style="color: white; align-self: center">Check Your Application Status</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         <?= $this->Form->create(null,['url'=>['controller'=>'Students','action'=>'checkstatus'],'id'=>'statuscheck']) ?>
          <div class="col-sm-12 mb-3 mb-sm-0">
<?= $this->Form->control('application_no', ['label' => false, 'placeholder' => 'Enter your application Number',
      'class' => 'form-control form-control-user2', 'required','id'=>'application_id'])
?>
                                </div>
          
          <div class="col-sm-12 mb-3 mb-sm-0" id="res">
              
          </div>
          
          <br /> <br />
          <?= $this->Form->button('Check Status', ['class' => 'btn btn-primary btn-sm','onClick'=>'submitCheckForm()']) ?>
<?= $this->Form->end() ?>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
    
    
    <script language="javascript" type="text/javascript">
    function submitCheckForm() {
       var application_no = document.getElementById('application_id').value;
      // alert(application_no);
        
   
     $.ajax({
        url: '../Students/checkstatus/'+application_no,
        method: 'GET',
        dataType: 'text',
        success: function(response) {
            console.log(response);
            document.getElementById('res').innerHTML = "";
            document.getElementById('res').innerHTML = response;
            //location.href = redirect;
            
        }
    });   
    event.preventDefault();
    }
</script>
