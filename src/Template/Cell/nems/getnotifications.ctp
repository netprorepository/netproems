<?php if(!empty($notifications)){ $count = 0;
     foreach ($notifications as $notification){
  ?>
<a class="dropdown-item d-flex align-items-center" href="#" onclick="getnotificationdata();">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500"><?=date('M d, Y', strtotime($notification->datecreated)) ?></div>
                                            <span class="font-weight-bold"><?=$notification->title  ?></span>
<!--                                            <div><?=$notification->message ?></div>-->
                                        </div>
      
                                    </a>
<?php  }} ?>
