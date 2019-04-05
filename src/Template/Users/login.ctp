<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block bg-login-imge" >
                     <?=$this->Html->image('alogo.png',['height'=>'100%','width'=>'100%','href'=>'/']); ?>
                </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                      <?= $this->Flash->render() ?>
  <?= $this->Form->create(null,[ 'url' => ['controller' => 'users', 'action' => 'login'],'class'=>'user']); ?> 
              
                    <div class="form-group">
                   <?php
                      echo $this->Form->control('username', 
                      ['class'=>'form-control form-control-user', 'label'=>false, 'type'=>'email','placeholder'=>'username','required',
                          'id'=>'exampleInputEmail','aria-describedby'=>'emailHelp','placeholder'=>'Enter Your Username']
                      );
                  ?>
                      </div>
                    <div class="form-group">
                   <?php
                      echo $this->Form->control('password', 
                      ['class'=>'form-control form-control-user', 'type'=>'password','label'=>false,'required',
                          'id'=>'exampleInputPassword','placeholder'=>'Enter Your Password']
                      );
                  ?>
                    
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                     <?= $this->Form->button('Sign In',['class'=>'btn btn-primary btn-user btn-block']) ?> 
                   
                    <hr>
                     <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
<!--                    <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a>-->
                           <?= $this->Form->end() ?>
                  <hr>
                 
                  <div class="text-center">
                    <a class="small" href="register.html">New Applicant</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
