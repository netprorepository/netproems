<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Staffmessage $staffmessage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Staffmessage'), ['action' => 'edit', $staffmessage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Staffmessage'), ['action' => 'delete', $staffmessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $staffmessage->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Staffmessages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Staffmessage'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teachers'), ['controller' => 'Teachers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teacher'), ['controller' => 'Teachers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="staffmessages view large-9 medium-8 columns content">
    <h3><?= h($staffmessage->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($staffmessage->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message') ?></th>
            <td><?= h($staffmessage->message) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Teacher') ?></th>
            <td><?= $staffmessage->has('teacher') ? $this->Html->link($staffmessage->teacher->firstname, ['controller' => 'Teachers', 'action' => 'view', $staffmessage->teacher->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $staffmessage->has('user') ? $this->Html->link($staffmessage->user->username, ['controller' => 'Users', 'action' => 'view', $staffmessage->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($staffmessage->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($staffmessage->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Datecreated') ?></th>
            <td><?= h($staffmessage->datecreated) ?></td>
        </tr>
    </table>
</div>
