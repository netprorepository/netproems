 <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Department of : <?= $programe->has('department') ? 
         $this->Html->link($programe->department->name, ['controller' => 'Departments', 'action' => 'viewdepartment', 
             $programe->department->id]) : '' ?></h1>

          <div class="row">

            <div class="col-lg-12">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Faculty of : <?=$this->Html->link($programe->department->faculty->name, ['controller' => 'Faculties', 'action' => 'viewfaculty', $programe->department->faculty->id]) ?></td>
     </h6>
                </div>
                <div class="card-body">
                  <p>Programme  </p>
                  <!-- Circle Buttons (Default) -->
                   <?php 
          
                  echo h($programe->name.' / '.$programe->programecode);
                   ?>
                 
                </div>
              </div>

            </div>


          </div>

        </div>
        <!-- /.container-fluid -->


