<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sparent[]|\Cake\Collection\CollectionInterface $sparents
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sparent'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="sparents index large-9 medium-8 columns content">
    <h3><?= __('Sparents') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fathersname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mothersname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fatherphone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('motherphone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fathersjob') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mothersjob') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pemailaddress') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sparents as $sparent): ?>
            <tr>
                <td><?= $this->Number->format($sparent->id) ?></td>
                <td><?= h($sparent->fathersname) ?></td>
                <td><?= h($sparent->mothersname) ?></td>
                <td><?= h($sparent->fatherphone) ?></td>
                <td><?= h($sparent->motherphone) ?></td>
                <td><?= h($sparent->fathersjob) ?></td>
                <td><?= h($sparent->mothersjob) ?></td>
                <td><?= $this->Number->format($sparent->pemailaddress) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $sparent->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $sparent->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $sparent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sparent->id)]) ?>
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
