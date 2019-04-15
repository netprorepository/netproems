<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <!--          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>-->
                <div class="col-lg-12">
                    
                    <div class="card">
  <div class="card-header">Subject : <?=$topic->subject->name?> | Topic : <?=$topic->title?></div>
  <div class="card-body">
        <?=$topic->contents?>
  </div> 
  <div class="card-footer">Last Updated on : <?=$topic->updatedon?></div>
</div>
                    
                     </div>
            </div>
        </div>
    </div>

</div>
