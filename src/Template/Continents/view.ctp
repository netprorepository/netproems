<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Continent $continent
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Continent'), ['action' => 'edit', $continent->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Continent'), ['action' => 'delete', $continent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $continent->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Continents'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Continent'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Trequests'), ['controller' => 'Trequests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trequest'), ['controller' => 'Trequests', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="continents view large-9 medium-8 columns content">
    <h3><?= h($continent->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($continent->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($continent->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($continent->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cost') ?></th>
            <td><?= $this->Number->format($continent->cost) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Trequests') ?></h4>
        <?php if (!empty($continent->trequests)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Orderdate') ?></th>
                <th scope="col"><?= __('Institution') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Continent Id') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Courier Id') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($continent->trequests as $trequests): ?>
            <tr>
                <td><?= h($trequests->id) ?></td>
                <td><?= h($trequests->student_id) ?></td>
                <td><?= h($trequests->orderdate) ?></td>
                <td><?= h($trequests->institution) ?></td>
                <td><?= h($trequests->status) ?></td>
                <td><?= h($trequests->continent_id) ?></td>
                <td><?= h($trequests->country_id) ?></td>
                <td><?= h($trequests->state_id) ?></td>
                <td><?= h($trequests->address) ?></td>
                <td><?= h($trequests->courier_id) ?></td>
                <td><?= h($trequests->amount) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Trequests', 'action' => 'view', $trequests->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Trequests', 'action' => 'edit', $trequests->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Trequests', 'action' => 'delete', $trequests->id], ['confirm' => __('Are you sure you want to delete # {0}?', $trequests->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
