<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coursematerial $coursematerial
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Coursematerial'), ['action' => 'edit', $coursematerial->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Coursematerial'), ['action' => 'delete', $coursematerial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coursematerial->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Coursematerials'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Coursematerial'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teachers'), ['controller' => 'Teachers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teacher'), ['controller' => 'Teachers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="coursematerials view large-9 medium-8 columns content">
    <h3><?= h($coursematerial->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= $coursematerial->has('subject') ? $this->Html->link($coursematerial->subject->name, ['controller' => 'Subjects', 'action' => 'view', $coursematerial->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Teacher') ?></th>
            <td><?= $coursematerial->has('teacher') ? $this->Html->link($coursematerial->teacher->firstname, ['controller' => 'Teachers', 'action' => 'view', $coursematerial->teacher->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($coursematerial->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fileurl') ?></th>
            <td><?= h($coursematerial->fileurl) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $coursematerial->has('department') ? $this->Html->link($coursematerial->department->name, ['controller' => 'Departments', 'action' => 'view', $coursematerial->department->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comment') ?></th>
            <td><?= h($coursematerial->comment) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($coursematerial->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Created') ?></th>
            <td><?= h($coursematerial->date_created) ?></td>
        </tr>
    </table>
</div>
