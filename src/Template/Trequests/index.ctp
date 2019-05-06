<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Trequest[]|\Cake\Collection\CollectionInterface $trequests
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Trequest'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Continents'), ['controller' => 'Continents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Continent'), ['controller' => 'Continents', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Couriers'), ['controller' => 'Couriers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Courier'), ['controller' => 'Couriers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="trequests index large-9 medium-8 columns content">
    <h3><?= __('Trequests') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('student_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('orderdate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('institution') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('continent_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('courier_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trequests as $trequest): ?>
            <tr>
                <td><?= $this->Number->format($trequest->id) ?></td>
                <td><?= $trequest->has('student') ? $this->Html->link($trequest->student->fname, ['controller' => 'Students', 'action' => 'view', $trequest->student->id]) : '' ?></td>
                <td><?= h($trequest->orderdate) ?></td>
                <td><?= h($trequest->institution) ?></td>
                <td><?= h($trequest->status) ?></td>
                <td><?= $trequest->has('continent') ? $this->Html->link($trequest->continent->name, ['controller' => 'Continents', 'action' => 'view', $trequest->continent->id]) : '' ?></td>
                <td><?= $trequest->has('country') ? $this->Html->link($trequest->country->name, ['controller' => 'Countries', 'action' => 'view', $trequest->country->id]) : '' ?></td>
                <td><?= $trequest->has('state') ? $this->Html->link($trequest->state->name, ['controller' => 'States', 'action' => 'view', $trequest->state->id]) : '' ?></td>
                <td><?= h($trequest->address) ?></td>
                <td><?= $trequest->has('courier') ? $this->Html->link($trequest->courier->name, ['controller' => 'Couriers', 'action' => 'view', $trequest->courier->id]) : '' ?></td>
                <td><?= h($trequest->amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $trequest->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $trequest->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $trequest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $trequest->id)]) ?>
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
