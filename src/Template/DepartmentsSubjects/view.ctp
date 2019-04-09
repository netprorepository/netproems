<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DepartmentsSubject $departmentsSubject
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Departments Subject'), ['action' => 'edit', $departmentsSubject->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Departments Subject'), ['action' => 'delete', $departmentsSubject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentsSubject->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Departments Subjects'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Departments Subject'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="departmentsSubjects view large-9 medium-8 columns content">
    <h3><?= h($departmentsSubject->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $departmentsSubject->has('department') ? $this->Html->link($departmentsSubject->department->name, ['controller' => 'Departments', 'action' => 'view', $departmentsSubject->department->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= $departmentsSubject->has('subject') ? $this->Html->link($departmentsSubject->subject->name, ['controller' => 'Subjects', 'action' => 'view', $departmentsSubject->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($departmentsSubject->id) ?></td>
        </tr>
    </table>
</div>
