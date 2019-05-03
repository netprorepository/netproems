<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Staffmessage[]|\Cake\Collection\CollectionInterface $staffmessages
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Staffmessage'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teachers'), ['controller' => 'Teachers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Teacher'), ['controller' => 'Teachers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="staffmessages index large-9 medium-8 columns content">
    <h3><?= __('Staffmessages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message') ?></th>
                <th scope="col"><?= $this->Paginator->sort('datecreated') ?></th>
                <th scope="col"><?= $this->Paginator->sort('teacher_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($staffmessages as $staffmessage): ?>
            <tr>
                <td><?= $this->Number->format($staffmessage->id) ?></td>
                <td><?= h($staffmessage->title) ?></td>
                <td><?= h($staffmessage->message) ?></td>
                <td><?= h($staffmessage->datecreated) ?></td>
                <td><?= $staffmessage->has('teacher') ? $this->Html->link($staffmessage->teacher->firstname, ['controller' => 'Teachers', 'action' => 'view', $staffmessage->teacher->id]) : '' ?></td>
                <td><?= $staffmessage->has('user') ? $this->Html->link($staffmessage->user->username, ['controller' => 'Users', 'action' => 'view', $staffmessage->user->id]) : '' ?></td>
                <td><?= h($staffmessage->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $staffmessage->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $staffmessage->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $staffmessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $staffmessage->id)]) ?>
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
