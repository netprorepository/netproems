<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subject $subject

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subject Teachers'), ['controller' => 'SubjectTeachers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject Teacher'), ['controller' => 'SubjectTeachers', 'action' => 'add']) ?></li>
    </ul>
</nav> 
 */
?>
<div class="subjects form large-9 medium-8 columns content">
    <?= $this->Form->create($subject) ?>
    <fieldset>
        <legend><?= __('Add Subject') ?></legend>
        <?php
        
            echo "<div class='col-md-6'>";
            echo $this->Form->control('name', ['class' => 'form-control form-control-user2', 'id'=>  'name']) . "<br\>";
            echo "</div>";
            echo "<div class='col-md-6'>";
            echo $this->Form->control('subjectcode', ['class' => 'form-control form-control-user2', 'id'=>  'subjectcode']) . "<br\>";
            echo "</div>";
            echo "<div class='col-md-6'>";
            echo $this->Form->control('department_id', ['options' => $departments, 'class' => 'form-control form-control-user2', 'id'=>  'department_id']) . "<br\>";
            echo "</div>";
             echo "<div class='col-md-6'>";
            echo $this->Form->control('creditload', ['options' => $departments, 'class' => 'form-control form-control-user2', 'id'=>  'creditload']) . "<br\>";
            echo "</div>";
             echo "<div class='col-md-6'>";
            echo $this->Form->control('user_id', ['options' => $users, 'class' => 'form-control form-control-user2', 'id'=>  'user_id']) . "<br\>";
             echo "</div>";
            
            
            ?>
    </fieldset>
     <br /> <br />
     <div class='col-md-6'>
     <?= $this->Form->button('Submit', ['class' => 'btn btn-primary btn-user btn-block']) ?>
                        <?= $this->Form->end() ?>
      </div>
</div>
