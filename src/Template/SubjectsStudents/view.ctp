<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SubjectsStudent $subjectsStudent
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Subjects Student'), ['action' => 'edit', $subjectsStudent->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Subjects Student'), ['action' => 'delete', $subjectsStudent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subjectsStudent->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Subjects Students'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subjects Student'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="subjectsStudents view large-9 medium-8 columns content">
    <h3><?= h($subjectsStudent->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= $subjectsStudent->has('subject') ? $this->Html->link($subjectsStudent->subject->name, ['controller' => 'Subjects', 'action' => 'view', $subjectsStudent->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student') ?></th>
            <td><?= $subjectsStudent->has('student') ? $this->Html->link($subjectsStudent->student->id, ['controller' => 'Students', 'action' => 'view', $subjectsStudent->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($subjectsStudent->id) ?></td>
        </tr>
    </table>
</div>
