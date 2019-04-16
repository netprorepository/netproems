<?php
$userdata = $this->request->getSession()->read('usersinfo');
$userrole = $this->request->getSession()->read('usersroles');
?>


<!-- Begin Page Content -->
        <div class="container-fluid">
            <div style="padding-bottom: 10px; margin-bottom: 20px;">
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Transactions</h1></div>
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Transactions</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
            <tr>
            <tr>
                
                <th scope="col"><?= $this->Paginator->sort('Student') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Transaction Date') ?></th>
                <th>Session</th>
                <th scope="col"><?= $this->Paginator->sort('Amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Ref') ?></th>
               
              
            </tr>
            
                  <tfoot>
                      <tr>
                
                <th scope="col"><?= $this->Paginator->sort('Student') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Transaction Date') ?></th>
                <th>Session</th>
                <th scope="col"><?= $this->Paginator->sort('Amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Ref') ?></th>
               
              
            </tr>
                  </tfoot>
        </thead>
        <tbody>
            <?php $paidsum = 0; foreach ($transactions as $transaction): ?>
            <tr>
              
                <td><?= $transaction->has('student') ? $this->Html->link($transaction->student->fname.' '.$transaction->student->lname, ['controller' => 'Students', 'action' => 'view', $transaction->student->id]) : '' ?></td>
                <td><?= h($transaction->transdate) ?></td>
                <td><?= h($transaction->session->name) ?></td>
                <td><?= number_format($transaction->amount) ?></td>
                <td>
                    <?php if($transaction->paystatus=="completed"){
                        $paidsum +=$transaction->amount;
               echo (' <span class="badge badge-success">'.$transaction->paystatus.'</span>');}
                   
                   else{ 
                        echo (' <span class="badge badge-info">'.$transaction->paystatus.'</span>');
                   }?>
               </td>
                <td><?= h($transaction->payref) ?></td>
               
                
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
       Total Completed : <span class="text-info" style="text-decoration: underline #00c292 solid;"> <?= number_format($paidsum)?></span>   
           
              </div>
            </div>
          </div>

        </div>
