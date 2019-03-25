   <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
                <?= $this->Flash->render() ?>
  <?= $this->Form->create(null,[ 'url' => ['controller' => 'users', 'action' => 'login']]); ?> 
              <h1>User Login Form</h1>
              <div>
                   <?php
                      echo $this->Form->control('username', 
                      ['class'=>'form-control', 'label'=>false, 'type'=>'email','placeholder'=>'username','required']
                      );
                  ?>
               
              </div>
              <div>
               <?php
                      echo $this->Form->control('password', 
                      ['class'=>'form-control', 'type'=>'password','label'=>false,'required']
                      );
                  ?>
              </div>
              <div>
                   <?= $this->Form->button('Sign In',['class'=>'btn btn-default submit']) ?> 
               
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New Applicant?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                   <h1><i class="fa fa-paw"></i> NetPro Int'l</h1>
                  <p>©<?=date('Y')?> All Rights Reserved.</p>
                </div>
              </div>
           <?= $this->Form->end() ?>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <?= $this->Flash->render() ?>
  <?= $this->Form->create(null,[ 'url' => ['controller' => 'users', 'action' => 'login']]); ?> 
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> NetPro Int'l</h1>
                  <p>©<?=date('Y')?> All Rights Reserved.</p>
                </div>
              </div>
            <?= $this->Form->end() ?>
          </section>
        </div>
      </div>
    </div>