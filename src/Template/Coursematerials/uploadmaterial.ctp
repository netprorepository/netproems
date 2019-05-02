<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
<!--          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>-->
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Course Materials Upload</h1>
              </div>
    <?= $this->Form->create($coursematerial,['type'=>'file']) ?>
    <fieldset>
      
         <div class="form-group row">
                      <div class="col-sm-4">
        <?php
            echo $this->Form->control('subject_id', ['label'=>'Select Subject','options' => $subjects,'class' => 'form-control form-control-user2','empty'=>'Select Course','required'])?>
                      </div>
               <div class="col-sm-8">
         
            <?= $this->Form->control('title',['label'=>'Title','required','placeholder'=>'title','class'=>'form-control form-control-user2'])?>
               </div>
             
                </div> 
           <div class="form-group row">
               <div class="col-sm-4">
           <?= $this->Form->control('dfileurl',['label'=>'Choose File','type'=>'file','required','class'=>'form-control form-control-user2'])?>
             </div>
                      <div class="col-sm-4">
            <?= $this->Form->control('department_id', ['label'=>'Select Department','required','options' => $departments,'class'=>'form-control form-control-user2'])?>
                      </div>
               <div class="col-sm-4">
            <?= $this->Form->control('comment',['label'=>'Comment(optional)','class'=>'form-control form-control-user2'])?>
               </div>
         </div>
    </fieldset>
       <br /> <br />
                        <?= $this->Form->button('Upload', ['class' => 'btn btn-primary btn-user btn-block']) ?>
                        <?= $this->Form->end() ?>
             
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
