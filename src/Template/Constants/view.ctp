<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Constant $constant
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Constant'), ['action' => 'edit', $constant->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Constant'), ['action' => 'delete', $constant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $constant->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Constants'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Constant'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="constants view large-9 medium-8 columns content">
    <h3><?= h($constant->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($constant->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Value') ?></th>
            <td><?= h($constant->value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($constant->id) ?></td>
        </tr>
    </table>
</div>
