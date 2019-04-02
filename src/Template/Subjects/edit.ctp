<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subject $subject
 */
?>

<div class="subjects form large-9 medium-8 columns content">
    <?= $this->Form->create($subject) ?>
    <fieldset>
        <legend><?= __('Edit Subject') ?></legend>
        <?php
             echo "<div class='col-md-6'>";
            echo $this->Form->control('name', ['class' => 'form-control form-control-user2',]);
            echo $this->Form->control('subjectcode', ['class' => 'form-control form-control-user2']);
            echo $this->Form->control('department_id', ['options' => $departments, 'class' => 'form-control form-control-user2']);
            echo $this->Form->control('creditload', ['class' => 'form-control form-control-user2']);
            echo $this->Form->control('user_id', ['options' => $users, 'class' => 'form-control form-control-user2']);
            echo "</div>";
        ?>
    </fieldset>
    <br /> <br />
   <div class="col-md-6">
        <?= $this->Form->button('Submit', ['class' => 'btn btn-primary btn-user btn-block']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
