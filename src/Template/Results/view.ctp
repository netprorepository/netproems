<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Result $result
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Result'), ['action' => 'edit', $result->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Result'), ['action' => 'delete', $result->id], ['confirm' => __('Are you sure you want to delete # {0}?', $result->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Results'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Result'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Faculties'), ['controller' => 'Faculties', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Faculty'), ['controller' => 'Faculties', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Semesters'), ['controller' => 'Semesters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Semester'), ['controller' => 'Semesters', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sessions'), ['controller' => 'Sessions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session'), ['controller' => 'Sessions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="results view large-9 medium-8 columns content">
    <h3><?= h($result->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Student') ?></th>
            <td><?= $result->has('student') ? $this->Html->link($result->student->id, ['controller' => 'Students', 'action' => 'view', $result->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Faculty') ?></th>
            <td><?= $result->has('faculty') ? $this->Html->link($result->faculty->name, ['controller' => 'Faculties', 'action' => 'view', $result->faculty->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $result->has('department') ? $this->Html->link($result->department->name, ['controller' => 'Departments', 'action' => 'view', $result->department->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= $result->has('subject') ? $this->Html->link($result->subject->name, ['controller' => 'Subjects', 'action' => 'view', $result->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Semester') ?></th>
            <td><?= $result->has('semester') ? $this->Html->link($result->semester->name, ['controller' => 'Semesters', 'action' => 'view', $result->semester->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Session') ?></th>
            <td><?= $result->has('session') ? $this->Html->link($result->session->name, ['controller' => 'Sessions', 'action' => 'view', $result->session->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Grade') ?></th>
            <td><?= h($result->grade) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Remark') ?></th>
            <td><?= h($result->remark) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $result->has('user') ? $this->Html->link($result->user->username, ['controller' => 'Users', 'action' => 'view', $result->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Regno') ?></th>
            <td><?= h($result->regno) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($result->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Score') ?></th>
            <td><?= $this->Number->format($result->score) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Creditload') ?></th>
            <td><?= $this->Number->format($result->creditload) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uploaddate') ?></th>
            <td><?= h($result->uploaddate) ?></td>
        </tr>
    </table>
</div>
