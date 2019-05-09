<?php
$userdata = $this->request->getSession()->read('usersinfo');
$userrole = $this->request->getSession()->read('usersroles');
?>


<!-- Begin Page Content -->
        <div class="container-fluid">
            <div style="padding-bottom: 10px; margin-bottom: 20px;">
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Transcript System</h1></div>
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Student Transcript</h6>
            </div>
              <div class="card-body">
                  
             <?= $this->Flash->render() ?>
                        <?php
                        if (!empty($student->results)) {
                            ?>
                            <div class="col-md-12 col-xs-12">
                                <p>TOPS ID : <?php $transcript_id = "ISP/ESR/" . mt_rand();
                        echo $transcript_id; ?></p>
                                  <?php echo $this->Html->image('logo-icon.png', ['alt' => 'EMS',  'style' => 'margin-top: 5px;','class'=>'float-right']) ?>
                           <?= $this->Html->image($student->passporturl, ['alt' => 'IMG', 'class' => 'img-responsive img-fluid float-left',
                                    'style' => 'width:80px;height:80px;']) ?>
                            </div>
                  
                            <div class="text-center" style="text-align: center; margin-bottom: 5px;">
                                <span class="school-name">Imo State Polytechnic</span><br>
                                <span class="mail-bag">P.M.B. 1472, Umuagwo, Imo State, 
                                    Office of the Registrar Statistic and Record Unit.
                                    Nigeria</span><br>
  

                            </div>
                  <div class="row">
                            <div class="col-md-6 col-xs-6">
                               <br /><br /> <span><small>Rector</small></span><br>
                                <span class="school-name">Rev. Fr. W. Madu</span><br>
                                <span><small>B.Sc(UNN);M.Sc(U.S.A);Ph.D(ABSU)</small></span><br>
                            </div>
                            <div class="col-md-6 text-center  col-xs-6">
                               <br /><br /> <span><small>Registrar</small></span><br>
                                <span class="school-name">Mrs. S. Njemanze</span><br>
                                <span><small>B.Arts(Hons),FCIA.FIIA MNIM</small></span><br>
                            </div>
                  </div>
                            <div class="col-md-4 col-xs-4 col-md-offset-4 col-xs-offset-4" style="text-align: center; margin-bottom: 5px;">
                            <br /><br />    <span class="office-name">OFFICE OF THE REGISTRAR</span><br>
                            </div>
                            <div class="col-md-4 col-xs-4 col-md-offset-8 col-xs-offset-8" style="text-align: right;">
                                <span class="mail-bag float-left"><?php echo date('M j, Y'); ?></span><br />
                            </div>
                            <div class="col-md-12 col-xs-12" style="text-align: left;">
    <?php foreach ( $trequest as $requestdetail): ?>
                                    <span class=""><?php echo ucfirst( $requestdetail->institution); ?></span><br>
                                    <span class="">
                                    <?php echo ucfirst( $requestdetail->address); ?>
                                    </span><br><br>
    <?php endforeach; ?>
                            </div>
                            <div class="col-md-6 col-xs-6" style="text-align: left;">
                                <span><small>ACADEMIC TRANSCRIPT OF</small></span>
                                <span class="school-name"><?php echo $student->ftname . " " . $student->lname . " " . $student->mname; ?></span><br>
                                <span class="office-name">REGISTRATION NO : <small><?php echo $student->regno ?></small></span><br>
                            </div>
                            <div class="col-md-6 col-xs-6" style="text-align: left;">
                                <span></span><br>
                                <span></span><br>
                                <span class="office-name">Department : <small>
    <?= $student->department->name ?>
                                    </small></span><br><br>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <p>We have been asked to forward to you, the academic transcript of the above named student/ex-student of Imo State Polytechnic,
                                    Umuagwo, Nigeria. The Candidate is/was of Our Department of <?php echo $student->department->name; ?>.
                                    <br>
                                    The Transcript is herewith enclosed. You will have to testify yourself that <strong>
    <?php echo $student->fname . " " . $student->lname . " " . $student->lname; ?>
                                    </strong> of our record and the one requesting us to send the transcript is one and the same person
                                    <br>The <strong>TRANSCRIPT</strong> is confidential and on no account should the student or other unauthorised person(s) be allowed access to it
                                </p>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <p>Please acknowledge receipt of this transcript by sending an email to esr@imopoly.net, quoting the student's name and the Transcript ID at the top of this page. 
                                </p>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <p>Any other advisory document supplied by the candidate that may be enclosed should be treated as separate  from the transcript and attended at their merit.
                                </p>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <p>Mrs. S. Njemanze<br>
                                    REGISTRAR<br><br><br>
                                </p>
                                <p>
                                    <span><strong>The Transcript Details : </strong></span><br>

                                    <?php
                                    //select distinct session for the student
//                        foreach ($results as $result){
//                            echo "<span>First Year :  ({$result->sessions->sessionname})</span>,";
//                        }
                                    ?>

                                </p>
                            </div>
                            <!--div class="col-md-12 col-xs-12">
                                    <p>TOPS ID : <?php echo $transcript_id; ?></p>
                            </div-->
                            <!--div class="col-md-4 col-xs-4 col-md-offset-4 col-xs-offset-4" style="text-align: center; margin-bottom: 5px;">
                                    <span class="school-name">Imo State Polytechnic</span><br>
                            <span class="mail-bag">P.M.B. 1472, Umuagwo, Imo State, 
              Office of the Registrar Statistic and Record Unit.
              Nigeria</span><br>
                                    <img src="images/logo-icon.png" style="margin-top: 5px;"><br><br><br>
                                    <span class="">Transcript Of Student Academic Records</span><br>
                            </div-->
                            <div class="col-md-6 col-xs-6">
                                <p><strong>FULL NAME : </strong><?php echo $student->fname . " " . $student->lname . " " . $student->mname; ?></p>
                                <p><strong>STUDENT REG NO : </strong><?php echo  $student->regno ?></p>
                                <p><strong>NATIONALITY : </strong><?php echo  $student->country->name ?></p>
                               
                                <p><strong>PRESENT ADDRESS : </strong>
                                   <?=$student->address?>
                                </p>
                            </div>
                            <div class="col-md-6 col-xs-6" style="text-align: left">
                                <p><strong>SEX : </strong><?php echo $student->gender; ?></p>
                                <p><strong>DATE OF BIRTH : </strong><?= h(date("d-M-Y", strtotime($student->dob))) ?></p>
                                <p><strong>YEAR OF ENTRY : </strong> <?php echo date('Y', strtotime($student->joindate)) ?>
                                    <?php
//                                    $regnumb_explode = explode("-", $student->regnumb);
//                                    echo $regnumb_explode[0];
                                    ?>
                                </p><br><br><br><br>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <div class="row">
<!--                                    <div class="col-md-6 col-xs-6">
                                        <p><strong>SCHOOL : </strong>
                                            <?php echo strtoupper($student->faculty->name); ?>
                                        </p>
                                    </div>-->
                                    <div class="col-md-6 col-xs-6" style="text-align: right">
                                        <p><strong>DEPARTMENT : </strong><?php echo strtoupper($student->department->name); ?></p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12 col-sm-9 col-xs-12">
                                <table id="atatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%"
                                       style="margin-top: 23px;">
                                    <thead>
                                        <tr>

                                            <th>COURSE</th>
                                            <th>COURSE TITLE</th>
                                           <th>UNITS</th>
                                            <th>SCORE</th>
                                            <th>GRADE</th>
                                           <th>G POINT</th>
                                           
                                           <th>REMARK</th>
                                           <th>SEMESTER</th>
                                            <th>SESSION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    <?php foreach ($student->results as $result): ?>
                                            <tr>
                                                <td><?= h($result->subject->name) ?></td>
                                                <td><?= h($result->subject->subjectcode) ?></td>
                                                 <td>
                            <?php
                            //$grade_point = $this->getcreditunit($result->grade);
                            //echo $grade_point->value;
                            echo h($result->subject->creditload);
                            ?>
                                                </td>
                                                <td><?= $this->Number->format($result->score) ?></td>
                                                <td><?= h($result->grade) ?></td>
                                                <td> <?= $this->getgradepoint($result->subject->id,$result->grade) ?>  </td>
                                       
                                                <td><?= h($result->remark) ?></td>
                                                 <td><?= h($result->semester->name) ?></td>
                                                <td><?= h($result->session->name) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-12 col-xs-12">
                                <span class="office-name pull-right">FINAL CUMMULATIVE G.P.A : <b><?php $final_gp = $this->calculateCGPA($student->regno);
                                       if($final_gp==0){ echo 'Sorry, No Results Found';}else{echo $final_gp;}
                                        ?></b></span><br>
                                <table class="table table-bordered" id="transtab">
                                    <tbody>
                                        <tr>
                                            <th>Curriculum</th>
                                            <td><?php echo $student->department->name; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Degree</th>
                                            <td>
                                                <?php
                                                $department_explode = explode("/", $student->regno);
                                                //print_r($department_explode);
                                                if ($department_explode[1] == "ND") {
                                                    echo "National Diploma";
                                                } elseif ($department_explode[1] == "HND") {
                                                    echo "Higher National Diploma";
                                                } else {
                                                    echo "Certificate";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Class Of Degree</th>
                                            <td>
                                                <?php if($final_gp==0){     echo 'Sorry, No Result Was Found For This Student :'. str_replace('-', '/', $student->regnumb);}
                                                elseif ($final_gp >= "3.50") {
                                                    echo "Distinction";
                                                } elseif (($final_gp >= "3.00") && ($final_gp <= "3.49")) {
                                                    echo "Upper Credit";
                                                } elseif (($final_gp >= "2.50") && ($final_gp <= "2.99")) {
                                                    echo "Lower Credit";
                                                } elseif (($final_gp >= "2.00" ) && ($final_gp <= "2.49")) {
                                                    echo "Pass";
                                                } else {
                                                    echo "Fail";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Graduation Year</th>
                                            <td> OCTOBER, <?=date('Y')?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!--/. ends create here-->
                            <div class="col-md-6 col-xs-6">
                                <div class="row">
                                    <div class="col-md-6 col-xs-6">
                                        <table class="table table-bordered" id="transtab" style="margin-bottom: 0px !important;">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">CLASSIFICATION DEGREE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>3.50 - 4.00</th>
                                                    <td>DISTINCTION</td>
                                                </tr>
                                                <tr>
                                                    <th>3.00 - 3.49</th>
                                                    <td>UPPER CREDIT</td>
                                                </tr>
                                                <tr>
                                                    <th>2.50 - 2.99</th>
                                                    <td>LOWER CREDIT</td>
                                                </tr>
                                                <tr>
                                                    <th>2.00 - 2.49</th>
                                                    <td>PASS</td>
                                                </tr>
                                                <tr>
                                                    <th>0.00 - 1.99</th>
                                                    <td>FAIL</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <table class="table table-bordered" id="transtab" style="margin-bottom: 0px !important;">
                                            <thead>
                                                <tr>
                                                    <th colspan="3">GRADING SYSTEM</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>80 - ABOVE</th>
                                                    <td>A</td>
                                                    <td>4.00</td>
                                                </tr>
                                                <tr>
                                                    <th>70 - 79</th>
                                                    <td>AB</td>
                                                    <td>3.50</td>
                                                </tr>
                                                <tr>
                                                    <th>60 - 69</th>
                                                    <td>B</td>
                                                    <td>3.00</td>
                                                </tr>
                                                <tr>
                                                    <th>50 - 59</th>
                                                    <td>BC</td>
                                                    <td>2.50</td>
                                                </tr>
                                                <tr>
                                                    <th>40 - 49</th>
                                                    <td>C</td>
                                                    <td>2.00</td>
                                                </tr>
                                                <tr>
                                                    <th>30 - 39</th>
                                                    <td>CD</td>
                                                    <td>1.50</td>
                                                </tr>
                                                <tr>
                                                    <th>20 - 29</th>
                                                    <td>D</td>
                                                    <td>1.00</td>
                                                </tr>
                                                <tr>
                                                    <th>10 - 19</th>
                                                    <td>E</td>
                                                    <td>0.50</td>
                                                </tr>
                                                <tr>
                                                    <th>00 - 09</th>
                                                    <td>F</td>
                                                    <td>0.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-12 hidden-xs" style="margin-top: 5px;">
                                <input class="btn btn-success pull-right" type="button" name="print" value="Print Transcript"
                                       onclick="javascript:printDiv('printit')">
                <!--             <?= $this->Html->link(__('Download Transcript'), ['controller' => 'Admins', 'action' => 'downloadtranscript',$student->regnumb, $request_id],
                                     ['class'=>'btn btn-primary pull-left']) ?>
                                
                                <div id="editor"></div>
                                <button id="cmd" class="btn btn-primary pull-left">generate PDF</button>-->
                            </div>
                            <?php
                        } else {
                            ?>
                            <h2 style="text-align: center;">NO RESULT HAS BEEN UPLOADED FOR THIS STUDENT..</h2>
                        <?php } ?>
                             
                    </div>
                    <!--/.end x_content-->
                </div>
            </div>
        

<script language="javascript" type="text/javascript">
    
    function printDiv(divID) {
        //Get the HTML of div
        var divElements = document.getElementById(divID).innerHTML;
        //Get the HTML of whole page
        var oldPage = document.body.innerHTML;

        //Reset the page's HTML with div's HTML only
        document.body.innerHTML = 
          "<html><head><title></title></head><body>" + 
          divElements + "</body>";

        //Print Page
        window.print();

        //Restore orignal HTML
        document.body.innerHTML = oldPage;
    }
    

</script>