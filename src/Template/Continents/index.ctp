<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Continent[]|\Cake\Collection\CollectionInterface $continents
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Continent'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Trequests'), ['controller' => 'Trequests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Trequest'), ['controller' => 'Trequests', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="continents index large-9 medium-8 columns content">
    <h3><?= __('Continents') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cost') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($continents as $continent): ?>
            <tr>
                <td><?= h($continent->code) ?></td>
                <td><?= h($continent->name) ?></td>
                <td><?= $this->Number->format($continent->id) ?></td>
                <td><?= $this->Number->format($continent->cost) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $continent->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $continent->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $continent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $continent->id)]) ?>
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
