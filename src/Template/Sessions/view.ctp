<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Session $session
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Session'), ['action' => 'edit', $session->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Session'), ['action' => 'delete', $session->id], ['confirm' => __('Are you sure you want to delete # {0}?', $session->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sessions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Settings'), ['controller' => 'Settings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Setting'), ['controller' => 'Settings', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Transactions'), ['controller' => 'Transactions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Transaction'), ['controller' => 'Transactions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="sessions view large-9 medium-8 columns content">
    <h3><?= h($session->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($session->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $session->has('user') ? $this->Html->link($session->user->username, ['controller' => 'Users', 'action' => 'view', $session->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($session->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Createdate') ?></th>
            <td><?= h($session->createdate) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Settings') ?></h4>
        <?php if (!empty($session->settings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Regfee') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Invoiceprefix') ?></th>
                <th scope="col"><?= __('Adminprefix') ?></th>
                <th scope="col"><?= __('Logo') ?></th>
                <th scope="col"><?= __('Staffprefix') ?></th>
                <th scope="col"><?= __('Regnoformat') ?></th>
                <th scope="col"><?= __('Session Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($session->settings as $settings): ?>
            <tr>
                <td><?= h($settings->id) ?></td>
                <td><?= h($settings->type) ?></td>
                <td><?= h($settings->description) ?></td>
                <td><?= h($settings->regfee) ?></td>
                <td><?= h($settings->name) ?></td>
                <td><?= h($settings->address) ?></td>
                <td><?= h($settings->email) ?></td>
                <td><?= h($settings->phone) ?></td>
                <td><?= h($settings->invoiceprefix) ?></td>
                <td><?= h($settings->adminprefix) ?></td>
                <td><?= h($settings->logo) ?></td>
                <td><?= h($settings->staffprefix) ?></td>
                <td><?= h($settings->regnoformat) ?></td>
                <td><?= h($settings->session_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Settings', 'action' => 'view', $settings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Settings', 'action' => 'edit', $settings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Settings', 'action' => 'delete', $settings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $settings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Transactions') ?></h4>
        <?php if (!empty($session->transactions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Transdate') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Paystatus') ?></th>
                <th scope="col"><?= __('Payref') ?></th>
                <th scope="col"><?= __('Gresponse') ?></th>
                <th scope="col"><?= __('Session Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($session->transactions as $transactions): ?>
            <tr>
                <td><?= h($transactions->id) ?></td>
                <td><?= h($transactions->student_id) ?></td>
                <td><?= h($transactions->transdate) ?></td>
                <td><?= h($transactions->amount) ?></td>
                <td><?= h($transactions->paystatus) ?></td>
                <td><?= h($transactions->payref) ?></td>
                <td><?= h($transactions->gresponse) ?></td>
                <td><?= h($transactions->session_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Transactions', 'action' => 'view', $transactions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Transactions', 'action' => 'edit', $transactions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Transactions', 'action' => 'delete', $transactions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transactions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
