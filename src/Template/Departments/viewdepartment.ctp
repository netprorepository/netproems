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
                  <hr />
                   <p>Fees Applicable to this department  </p>
                  <?php if (!empty($department->fees)){
                      
                  foreach ($department->fees as $fee){
          
                  echo h($fee->name.'  -  N'.number_format($fee->amount,2)).'<br />';
                  
                   }} ?>
               
                  <?php if (!empty($department->subjects)){?>
                   <br /> <strong>Courses</strong>
                   <table class="table table-bordered table-striped table-hover" width="100%" cellspacing="0">
                       
                       <thead>
            <tr>
          
                <th >Name</th>
                <th >Course Code</th>
              
                <th>Credit Load</th>
                
            </tr>
                  </thead>
                      <tbody>
                 <?php foreach ($department->subjects as $subject){?>
                          <tr>
                              <td>
                                  <?=$subject->name?>
                              </td>
                              <td>
                                  <?=$subject->subjectcode?>
                              </td>
                              <td>
                                  <?=$subject->creditload?>
                              </td>
                          </tr>
          
                  <?php }}?>
                      </tbody>
                   </table>
                   <hr />
                </div>
              </div>

            </div>


          </div>

        </div>
        <!-- /.container-fluid -->
