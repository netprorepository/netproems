<?php
$userdata = $this->request->getSession()->read('usersinfo');
$userrole = $this->request->getSession()->read('usersroles');
?>
<!-- Begin Page Content -->
        <div class="container-fluid">
            <div style="padding-bottom: 10px; margin-bottom: 20px;">
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">My Results</h1></div>
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                               <h1 class="h4 text-gray-900 mb-4">Search Results</h1>
                        </div>
                        <?= $this->Form->create(null) ?>
                        <fieldset>

                            <div class="form-group row">
                         
                                <div class="col-sm-4">
                                    <?= $this->Form->control('subject_id', ['options' => $subjects,'label' => 'Select Course', 'placeholder' => 'Select Course'
                                        , 'class' => 'form-control','empty'=>'Select a Course'])
                                    ?>
                                </div>
                            
                           <div class="col-sm-4">
                                    <?= $this->Form->control('semester_id', ['options' => $semesters,'label' => 'Select Semester', 'placeholder' => 'Select Semester'
                                        , 'class' => 'form-control','empty'=>'Select Semester'])
                                    ?>
                                </div>  
                                <div class="col-sm-4">
                                    <?= $this->Form->control('session_id', ['options' => $sessions,'label' => 'Select Session', 'required', 'placeholder' => 'Select Session'
                                        , 'class' => 'form-control','empty'=>'Select Session'])
                                    ?>
                                </div>
                                              
                                </div>
                          
                        </fieldset>
                        <br /> <br />
<?= $this->Form->button('Search', ['class' => 'btn btn-primary btn-user btn-block']) ?>
<?= $this->Form->end() ?>

                    </div>
                </div>
                <?php if(!empty($results)){  ?>
            <center> <strong>Netpro Academy Internation<br />
                    No. 10, Wilfred Okereke Steet, Obinze Owerri Imo State.</strong></center>
             Name : <?=$student->fname. ' '.$student->lname.' '.$student->mname ?><br />
             Regno : <?=$student->regno?><br />
             Department : <?=$student->department->name?><br />
             <br />
                 <div class="card shadow mb-4">
                   
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">My Results </h6>
            </div>
                     
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
            <tr>
             <th>Course</th>
                <th >Semester</th>
                <th >Session</th>
                <th>Score</th>
                <th>Grade</th>
                <th >Remark</th>
                <th>Credit Load</th>
            </tr>
                  </thead>
                  <tfoot>
                       <tr>
              
                <th>Course</th>
                <th >Semester</th>
                <th >Session</th>
                <th>Score</th>
                <th>Grade</th>
                <th >Remark</th>
                <th >Credit Load</th>
                
            </tr>
                  </tfoot>
      
        <tbody>
            <?php foreach ($results as $result): ?>
            <tr>
              
                 <td><?=$result->subject->name?></td>
                <td><?= $result->semester->name?></td>
                <td><?= $result->session->name ?></td>
                <td><?= $this->Number->format($result->score) ?></td>
                <td><?= h($result->grade) ?></td>
                <td><?= h($result->remark) ?></td>
                <td><?= $this->Number->format($result->creditload) ?></td>
               
            </tr>
            <?php endforeach; ?>
        </tbody>
       
     </table>
                   CGPA : <?= $this->calculateCGPA($student->regno) ?>
              </div>
            </div>
          </div>
                <?php }?>
            </div>
        

