<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SubjectTeacher $subjectTeacher
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Subject Teacher'), ['action' => 'edit', $subjectTeacher->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Subject Teacher'), ['action' => 'delete', $subjectTeacher->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subjectTeacher->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Subject Teachers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject Teacher'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teachers'), ['controller' => 'Teachers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teacher'), ['controller' => 'Teachers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="subjectTeachers view large-9 medium-8 columns content">
    <h3><?= h($subjectTeacher->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Teacher') ?></th>
            <td><?= $subjectTeacher->has('teacher') ? $this->Html->link($subjectTeacher->teacher->id, ['controller' => 'Teachers', 'action' => 'view', $subjectTeacher->teacher->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= $subjectTeacher->has('subject') ? $this->Html->link($subjectTeacher->subject->name, ['controller' => 'Subjects', 'action' => 'view', $subjectTeacher->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $subjectTeacher->has('user') ? $this->Html->link($subjectTeacher->user->id, ['controller' => 'Users', 'action' => 'view', $subjectTeacher->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($subjectTeacher->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created Date') ?></th>
            <td><?= h($subjectTeacher->created_date) ?></td>
        </tr>
    </table>
</div>
