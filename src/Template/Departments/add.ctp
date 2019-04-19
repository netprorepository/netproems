<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Departments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Faculties'), ['controller' => 'Faculties', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Faculty'), ['controller' => 'Faculties', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Dstudents'), ['controller' => 'Dstudents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Dstudent'), ['controller' => 'Dstudents', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Feeallocations'), ['controller' => 'Feeallocations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Feeallocation'), ['controller' => 'Feeallocations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Programes'), ['controller' => 'Programes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Programe'), ['controller' => 'Programes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fees'), ['controller' => 'Fees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fee'), ['controller' => 'Fees', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="departments form large-9 medium-8 columns content">
    <?= $this->Form->create($department) ?>
    <fieldset>
        <legend><?= __('Add Department') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
            echo $this->Form->control('created_date');
            echo $this->Form->control('faculty_id', ['options' => $faculties]);
            echo $this->Form->control('deptcode');
            echo $this->Form->control('subjects._ids', ['options' => $subjects]);
            echo $this->Form->control('fees._ids', ['options' => $fees]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
