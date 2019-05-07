<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Trequest $trequest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Trequest'), ['action' => 'edit', $trequest->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Trequest'), ['action' => 'delete', $trequest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $trequest->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Trequests'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trequest'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Continents'), ['controller' => 'Continents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Continent'), ['controller' => 'Continents', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Couriers'), ['controller' => 'Couriers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Courier'), ['controller' => 'Couriers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="trequests view large-9 medium-8 columns content">
    <h3><?= h($trequest->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Student') ?></th>
            <td><?= $trequest->has('student') ? $this->Html->link($trequest->student->fname, ['controller' => 'Students', 'action' => 'view', $trequest->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Institution') ?></th>
            <td><?= h($trequest->institution) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($trequest->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Continent') ?></th>
            <td><?= $trequest->has('continent') ? $this->Html->link($trequest->continent->name, ['controller' => 'Continents', 'action' => 'view', $trequest->continent->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= $trequest->has('country') ? $this->Html->link($trequest->country->name, ['controller' => 'Countries', 'action' => 'view', $trequest->country->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= $trequest->has('state') ? $this->Html->link($trequest->state->name, ['controller' => 'States', 'action' => 'view', $trequest->state->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($trequest->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Courier') ?></th>
            <td><?= $trequest->has('courier') ? $this->Html->link($trequest->courier->name, ['controller' => 'Couriers', 'action' => 'view', $trequest->courier->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= h($trequest->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($trequest->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Orderdate') ?></th>
            <td><?= h($trequest->orderdate) ?></td>
        </tr>
    </table>
</div>
