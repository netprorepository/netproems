<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subject $subject
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Subject'), ['action' => 'edit', $subject->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Subject'), ['action' => 'delete', $subject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subject->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="subjects view large-9 medium-8 columns content">
    <h3><?= h($subject->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($subject->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subjectcode') ?></th>
            <td><?= h($subject->subjectcode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $subject->has('department') ? $this->Html->link($subject->department->name, ['controller' => 'Departments', 'action' => 'view', $subject->department->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $subject->has('user') ? $this->Html->link($subject->user->username, ['controller' => 'Users', 'action' => 'view', $subject->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($subject->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Creditload') ?></th>
            <td><?= $this->Number->format($subject->creditload) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($subject->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created Date') ?></th>
            <td><?= h($subject->created_date) ?></td>
        </tr>
    </table>
</div>
