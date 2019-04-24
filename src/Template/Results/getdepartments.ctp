<?php 
    echo '<div class="col-md-12">';
        //$cities = ['1'=>'Mpape','2'=>'Yola','3'=>'Uyo'];
        echo $this->Form->control(
            'department_id', 
            ['options' =>  $departments, 'empty' => 'Select Department'],
            ['class'=>'chosen-select-no-single']
        );
    echo '</div>';
?>
