<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block bg-login-imge" >
                     <?php
                       //if(!empty($logo)){
                        // echo $this->Html->image($logo->logo,['height'=>'100%','width'=>'100%','href'=>'/']);
                     //} else {
                         echo $this->Html->image('bs.png',['height'=>'100%','width'=>'100%','href'=>'/']);
                     //}
                     ?>
                </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Change Password</h1>
                  </div>
                      <?= $this->Flash->render() ?>
  <?= $this->Form->create(null,[ 'url' => ['controller' => 'users', 'action' => 'forgotpassword'],'class'=>'user']); ?> 
              
                    <div class="form-group">
                   <?php
                      echo $this->Form->control('password', 
                      ['class'=>'form-control form-control-user', 'label'=>false, 'type'=>'password','placeholder'=>'new password','required',
                          'id'=>'exampleInputEmail','aria-describedby'=>'emailHelp']
                      );
                  ?>
                      </div>
                     <div class="form-group">
                   <?php
                      echo $this->Form->control('cpassword', 
                      ['class'=>'form-control form-control-user', 'label'=>false, 'type'=>'password','placeholder'=>'confirm new password','required',
                          'id'=>'exampleInputEmail','aria-describedby'=>'emailHelp']
                      );
                  ?>
                      </div>
                    
                    
                     <?= $this->Form->button('Change Password',['class'=>'btn btn-primary btn-user btn-block']) ?> 
                   
                    <hr>
                     <div class="text-center">
                           <?= $this->Html->link('login', ['controller' => 'Users', 'action' => 'login'], ['title' => 'login', 'class' => 'small'])?>
                   
                 
                  </div>
                           <?= $this->Form->end() ?>
                  <hr>
                 
                  <div class="text-center">
                      <?= $this->Html->link('New Applicant', ['controller' => 'Students', 'action' => 'newapplicant'], ['title' => 'apply now', 'class' => 'small'])?>
                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
