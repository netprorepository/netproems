<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <!--          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>-->
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create New Fee Allocation</h1>
                        </div>
                      <?= $this->Form->create($feeallocation) ?>
                        <fieldset>
            
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                        <?= $this->Form->control('fee_id', ['options'=>$fees, 'label' => false,'empty' => 'Select Fee ', 'required',
                                            'class' => 'form-control form-control-user2'])
                                        ?>
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <?= $this->Form->control('department_id', ['options' => $departments,'label' => false, 'empty' => 'Select Department', 'required',
                                        'class' => 'form-control form-control-user'])
                                    ?>
                                </div>
                            </div>
                              <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
              <?= $this->Form->control('startdate', ['label' => false, 'class' => 'form-control form-control-user2', 'type' => 'text', 'id' => 'datepicker','placeholder'=>'start date'])?>
                    </div>
                                       <div class="col-sm-6 mb-3 mb-sm-0">
              <?= $this->Form->control('enddate', ['label' => false, 'class' => 'form-control form-control-user2', 'type' => 'text', 'id' => 'datepicker2','placeholder'=>'end date'])?>
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

