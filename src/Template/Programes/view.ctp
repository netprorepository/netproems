<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Programe $programe
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Programe'), ['action' => 'edit', $programe->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Programe'), ['action' => 'delete', $programe->id], ['confirm' => __('Are you sure you want to delete # {0}?', $programe->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Programes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Programe'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="programes view large-9 medium-8 columns content">
    <h3><?= h($programe->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $programe->has('department') ? $this->Html->link($programe->department->name, ['controller' => 'Departments', 'action' => 'view', $programe->department->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Programecode') ?></th>
            <td><?= h($programe->programecode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($programe->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($programe->id) ?></td>
        </tr>
    </table>
</div>
