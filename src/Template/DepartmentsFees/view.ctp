<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DepartmentsFee $departmentsFee
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Departments Fee'), ['action' => 'edit', $departmentsFee->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Departments Fee'), ['action' => 'delete', $departmentsFee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentsFee->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Departments Fees'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Departments Fee'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fees'), ['controller' => 'Fees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fee'), ['controller' => 'Fees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="departmentsFees view large-9 medium-8 columns content">
    <h3><?= h($departmentsFee->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Fee') ?></th>
            <td><?= $departmentsFee->has('fee') ? $this->Html->link($departmentsFee->fee->name, ['controller' => 'Fees', 'action' => 'view', $departmentsFee->fee->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $departmentsFee->has('department') ? $this->Html->link($departmentsFee->department->name, ['controller' => 'Departments', 'action' => 'view', $departmentsFee->department->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($departmentsFee->id) ?></td>
        </tr>
    </table>
</div>
