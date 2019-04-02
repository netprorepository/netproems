<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Log $log
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Log'), ['action' => 'edit', $log->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Log'), ['action' => 'delete', $log->id], ['confirm' => __('Are you sure you want to delete # {0}?', $log->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Logs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Log'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="logs view large-9 medium-8 columns content">
    <h3><?= h($log->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($log->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $log->has('user') ? $this->Html->link($log->user->id, ['controller' => 'Users', 'action' => 'view', $log->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($log->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ip') ?></th>
            <td><?= h($log->ip) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($log->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($log->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Timestamp') ?></th>
            <td><?= h($log->timestamp) ?></td>
        </tr>
    </table>
</div>
