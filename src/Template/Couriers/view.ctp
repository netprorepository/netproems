<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Courier $courier
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Courier'), ['action' => 'edit', $courier->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Courier'), ['action' => 'delete', $courier->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courier->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Couriers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Courier'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Trequests'), ['controller' => 'Trequests', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trequest'), ['controller' => 'Trequests', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="couriers view large-9 medium-8 columns content">
    <h3><?= h($courier->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($courier->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($courier->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Trequests') ?></h4>
        <?php if (!empty($courier->trequests)): ?>
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
            <?php foreach ($courier->trequests as $trequests): ?>
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
