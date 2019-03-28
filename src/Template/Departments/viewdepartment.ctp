 <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Department of : <?= h($department->name) ?></h1>

          <div class="row">

            <div class="col-lg-12">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Faculty of : 
            <?= $department->has('faculty') ? $this->Html->link($department->faculty->name, ['controller' => 'Faculties', 'action' => 'viewfaculty', $department->faculty->id]) : '' ?></td>
     </h6>
                </div>
                <div class="card-body">
                  <p>List of programmes  </p>
                  <!-- Circle Buttons (Default) -->
                   <?php if (!empty($department->programes)){
                  foreach ($department->programes as $programes){
          
                  echo h($programes->name.' / '.$programes->programecode).'<br />';
                  
                   }} ?>
                 
                </div>
              </div>

            </div>


          </div>

        </div>
        <!-- /.container-fluid -->
