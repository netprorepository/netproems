<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <!--          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>-->
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Update Subject</h1>
                        </div>
    <?= $this->Form->create($subject) ?>
    <fieldset>
      <div class="form-group row">
          <div class="col-sm-4 mb-3 mb-sm-0">
              <?= $this->Form->control('name', ['label' => 'Subject Name', 'placeholder' => 'Subject Name', 'required',
                                          'class' => 'form-control form-control-user2']);?>
          </div>
          <div class="col-sm-4 mb-3 mb-sm-0">
              <?=$this->Form->control('subjectcode',['label' => 'Subject Code', 'placeholder' => 'Subject Code', 'required',
                                          'class' => 'form-control form-control-user2']);?>
          </div>
          <div class="col-sm-4 mb-3 mb-sm-0">
                <?= $this->Form->control('departments._ids', ['options' => $departments, 'label' => 'Select Department', 'empty' => 'Select Departments', 'class' => 'select2_multiple form-control form-control-user']) ?>
                              
          </div>
      </div>
        <div class="form-group row">
          <div class="col-sm-4 mb-3 mb-sm-0">
        <?php
        
            echo $this->Form->control('creditload',['label' => 'Credit Load', 'placeholder' => 'Credit Load', 'required',
                                          'class' => 'form-control form-control-user2']);?>
      
          </div>
            <div class="col-sm-4 mb-3 mb-sm-0">
                <?= $this->Form->control('teachers._ids', ['options' => $teachers, 'label' => 'Select Teacher', 'empty' => 'Select Teacher', 'class' => 'select2_multiple form-control form-control-user']) ?>
                              
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
