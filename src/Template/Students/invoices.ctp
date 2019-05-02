<?php
$userdata = $this->request->getSession()->read('usersinfo');
$userrole = $this->request->getSession()->read('usersroles');
?>


<!-- Begin Page Content -->
        <div class="container-fluid">
            <div style="padding-bottom: 10px; margin-bottom: 20px;">
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">My Invoices</h1></div>
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Student Invoice</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
            <tr>
          
                 <th >Fee Name</th>
                <th>Amount</th>
                <th>Date</th>
                 <th>Session</th>
                <th>Status</th>
                <th >Action</th>
               
            </tr>
                  </thead>
            
            
              <tfoot>
            <tr>
          
                  <th >Fee Name</th>
                <th>Amount</th>
                <th>Date</th>
                 <th>Session</th>
                <th>Status</th>
                <th >Action</th>
            </tr>
              </tfoot>
            
        
         <tbody>
            <?php foreach ($myinvoices as $invoice): ?>
            <tr>
                
                <td><?= h($invoice->fee->name) ?></td>
                <td><?= number_format($invoice->fee->amount) ?></td>
                <td><?= h($invoice->fee->startdate) ?></td>
               <td><?= h($invoice->session->name) ?></td>
               <td ><?php if($invoice->paystatus=="Unpaid"){
               echo (' <span class="badge badge-warning">'.$invoice->paystatus.'</span>');}
                   
                   else{
                        echo (' <span class="badge badge-success">Paid</span>');
                   }?>
               </td>
               
        
                <td class="actions">
                    
                    <?php if($invoice->paystatus=="success"){ echo $this->Html->link(__(' Payonline'), ['controller'=>'Students','action' => 'gotopaystack', $invoice->id,$invoice->student_id],
                            ['class'=>'btn btn-round btn-primary fa fa-money disabled','title'=>'pay online']);
                    }
                    else{
                    echo $this->Html->link(__(' Payonline'), ['controller'=>'Students','action' => 'gotopaystack', $invoice->id,$invoice->student_id],
                            ['class'=>'btn btn-round btn-primary fa fa-money','title'=>'pay online']);    
                    }
                    ?>
                    </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>




