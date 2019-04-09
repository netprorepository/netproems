<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fee[]|\Cake\Collection\CollectionInterface $fees
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Fee'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Feeallocations'), ['controller' => 'Feeallocations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Feeallocation'), ['controller' => 'Feeallocations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="fees index large-9 medium-8 columns content">
    <h3><?= __('Fees') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fees as $fee): ?>
            <tr>
                <td><?= $this->Number->format($fee->id) ?></td>
                <td><?= h($fee->name) ?></td>
                <td><?= $this->Number->format($fee->amount) ?></td>
                <td><?= $fee->has('user') ? $this->Html->link($fee->user->username, ['controller' => 'Users', 'action' => 'view', $fee->user->id]) : '' ?></td>
                <td><?= $this->Number->format($fee->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $fee->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $fee->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $fee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fee->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
