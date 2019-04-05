<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DepartmentsFee $departmentsFee
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Departments Fees'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Fees'), ['controller' => 'Fees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fee'), ['controller' => 'Fees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="departmentsFees form large-9 medium-8 columns content">
    <?= $this->Form->create($departmentsFee) ?>
    <fieldset>
        <legend><?= __('Add Departments Fee') ?></legend>
        <?php
            echo $this->Form->control('fee_id', ['options' => $fees]);
            echo $this->Form->control('department_id', ['options' => $departments]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
