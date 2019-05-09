 
     <?php foreach ($logs as $log){ ?>
<p style="font-weight: bolder; font-size: 14px;"><?=$log->user->username  ?>.</p>
<p class="mb-0"><?=$log->title.' on ' .date('D d M Y H:i a', strtotime($log->timestamp)) ?>.</p>
                  <p class="mb-0"><?=$log->description?>.</p>
                <hr>

     <?php }?>
