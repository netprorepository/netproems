<br />
<?php if(!empty($applicant)){
    
    if($applicant->status ==='Applied'){
 ?>
<div class="alert alert-info alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Success!</strong> Your Application is still being considered. We will get back to you shortly.
</div>
<?php }
elseif($applicant->status ==='Selected'){ ?>
<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Congratulation!</strong> You have been offered a provisional admission in our school. Please login with your username
  and password to pay the required fees and get your RegNo
</div>

<?php }else{?>
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Hey! </strong> You are probably our student already.
</div>
<?php }}else{ ?>
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Sorry! :  </strong> We could not find your details. Please ensure you are entering the right application number.
</div>
<?php } ?>




