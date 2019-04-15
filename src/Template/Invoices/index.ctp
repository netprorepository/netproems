<?php
$userdata = $this->request->getSession()->read('usersinfo');
$userrole = $this->request->getSession()->read('usersroles');
?>


<!-- Begin Page Content -->
        <div class="container-fluid">
            <div style="padding-bottom: 10px; margin-bottom: 20px;">
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Invoices</h1></div>
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Invoice</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
            <tr>
          
                 <th >Fee Name</th>
                <th>Amount</th>
                <th>Deadline</th>
                 <th>Session</th>
                <th>Status</th>
                
               
            </tr>
                  </thead>
            
            
              <tfoot>
            <tr>
          
                  <th >Fee Name</th>
                <th>Amount</th>
                <th>Deadline</th>
                <th>Status</th>
             
            </tr>
              </tfoot>
            
        
         <tbody>
            <?php $paidsum = 0; foreach ($invoices as $invoice): ?>
            <tr>
                
                <td><?= h($invoice->fee->name) ?></td>
                <td><?= number_format($invoice->fee->amount) ?></td>
                <td><?= h($invoice->fee->enddate) ?></td>
               <td><?= h($invoice->session->name) ?></td>
               <td ><?php if($invoice->paystatus=="Unpaid"){
               echo (' <span class="badge badge-warning">'.$invoice->paystatus.'</span>');}
                   
                   else{ $paidsum +=$invoice->fee->amount;
                        echo (' <span class="badge badge-success">Paid</span>');
                   }?>
               </td>
               
        
                
            </tr>
            <?php endforeach; ?>
            
        </tbody>
        
                </table>
                  Total Paid : <span class="text-info" style="text-decoration: underline #00c292 solid;"> <?= number_format($paidsum)?></span>   
              </div>
            </div>
          </div>

        </div>




