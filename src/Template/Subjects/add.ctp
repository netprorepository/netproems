<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subject $subject
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="subjects form large-9 medium-8 columns content">
    <?= $this->Form->create($subject) ?>
    <fieldset>
        <legend><?= __('Add Subject') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('subjectcode');
            echo $this->Form->control('department_id', ['options' => $departments]);
            echo $this->Form->control('creditload');
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('created_date');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
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
