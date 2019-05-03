<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Studentmessage $studentmessage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Studentmessage'), ['action' => 'edit', $studentmessage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Studentmessage'), ['action' => 'delete', $studentmessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentmessage->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Studentmessages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Studentmessage'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="studentmessages view large-9 medium-8 columns content">
    <h3><?= h($studentmessage->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($studentmessage->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Messages') ?></th>
            <td><?= h($studentmessage->messages) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student') ?></th>
            <td><?= $studentmessage->has('student') ? $this->Html->link($studentmessage->student->fname, ['controller' => 'Students', 'action' => 'view', $studentmessage->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $studentmessage->has('user') ? $this->Html->link($studentmessage->user->username, ['controller' => 'Users', 'action' => 'view', $studentmessage->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($studentmessage->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($studentmessage->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Created') ?></th>
            <td><?= h($studentmessage->date_created) ?></td>
        </tr>
    </table>
</div>
