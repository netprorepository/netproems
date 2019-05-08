<?php
$userdata = $this->request->getSession()->read('usersinfo');
$userrole = $this->request->getSession()->read('usersroles');
?>


<!-- Begin Page Content -->
        <div class="container-fluid">
            <div style="padding-bottom: 10px; margin-bottom: 20px;"><?= $this->Html->link(__(' '), ['action' => 'newstudent'],
                            ['class'=>'btn-circle btn-lg fa fa-plus float-right','title'=>'addmit new student']) ?>
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Manage Applicants</h1></div>
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Applicants Manager</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
            <tr>
          
                 <th scope="col"><?= $this->Paginator->sort('Name') ?></th>
               
               
                <th scope="col"><?= $this->Paginator->sort('DOB') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Date Applied') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Department') ?></th>
                 <th>Status</th>
<!--                <th scope="col"><?= $this->Paginator->sort('olevelresulturl') ?></th>
                <th scope="col"><?= $this->Paginator->sort('jamb') ?></th>
                <th scope="col"><?= $this->Paginator->sort('birthcerturl') ?></th>
                <th scope="col"><?= $this->Paginator->sort('othercerts') ?></th>-->
               
<!--                <th scope="col"><?= $this->Paginator->sort('state_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fathersname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mothersname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fatherphone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('motherphone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fathersjob') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mothersjob') ?></th>-->
                <th scope="col"><?= $this->Paginator->sort('Passport') ?></th>
               
<!--                <th scope="col"><?= $this->Paginator->sort('Regno') ?></th>-->
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
                  </thead>
            
            
              <tfoot>
            <tr>
          
                 <th scope="col"><?= $this->Paginator->sort('Name') ?></th>
                
               
                <th scope="col"><?= $this->Paginator->sort('DOB') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Date Applied') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Department') ?></th>
                <th>Status</th>
<!--                <th scope="col"><?= $this->Paginator->sort('olevelresulturl') ?></th>
                <th scope="col"><?= $this->Paginator->sort('jamb') ?></th>
                <th scope="col"><?= $this->Paginator->sort('birthcerturl') ?></th>
                <th scope="col"><?= $this->Paginator->sort('othercerts') ?></th>-->
               
<!--                <th scope="col"><?= $this->Paginator->sort('state_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fathersname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mothersname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fatherphone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('motherphone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fathersjob') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mothersjob') ?></th>-->
                <th scope="col"><?= $this->Paginator->sort('Passport') ?></th>
               
<!--                <th scope="col"><?= $this->Paginator->sort('Regno') ?></th>-->
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
              </tfoot>
            
     
         <tbody>
            <?php foreach ($students as $student): ?>
            <tr>
                
                <td><?= h($student->fname.' '.$student->lname) ?></td>
             
             
                <td><?= h($student->dob) ?></td>
                <td><?= h(date('D, d M Y', strtotime($student->joindate))) ?></td>
                <td><?= $student->has('department') ? $this->Html->link($student->department->name, ['controller' => 'Departments', 'action' => 'viewdepartment', $student->department->id]) : '' ?></td>
                <td><?= h($student->status) ?></td>
<!--                <td><?= h($student->olevelresulturl) ?></td>
                <td><?= $this->Number->format($student->jamb) ?></td>
                <td><?= h($student->birthcerturl) ?></td>
                <td><?= h($student->othercerts) ?></td>-->
              
<!--                <td><?= $student->has('state') ? $this->Html->link($student->state->name, ['controller' => 'States', 'action' => 'view', $student->state->id]) : '' ?></td>
                <td><?= $student->has('country') ? $this->Html->link($student->country->name, ['controller' => 'Countries', 'action' => 'view', $student->country->id]) : '' ?></td>
                <td><?= h($student->address) ?></td>
                <td><?= h($student->phone) ?></td>
                <td><?= h($student->fathersname) ?></td>
                <td><?= h($student->mothersname) ?></td>
                <td><?= h($student->fatherphone) ?></td>
                <td><?= h($student->motherphone) ?></td>
                <td><?= h($student->fathersjob) ?></td>
                <td><?= h($student->mothersjob) ?></td>-->
                <td> <?= $this->Html->image($student->passporturl, ['alt' => 'IMG', 'class' => 'img-circle profile_img',
                                    'style' => 'width:80px;height:80px;']) ?>
               </td>
              
<!--                <td><?= h($student->regno) ?></td>-->
                <td class="actions">
                    
                    <?= $this->Html->link(__(' '), ['action' => 'viewapplicant', $student->id,$this->Generateurl($student->fname)],
                            ['class'=>'btn btn-round btn-primary fa fa-edit','title'=>'view applicant details']) ?>
                    </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>



