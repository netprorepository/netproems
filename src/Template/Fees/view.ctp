<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fee $fee
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fee'), ['action' => 'edit', $fee->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fee'), ['action' => 'delete', $fee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fee->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Fees'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fee'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Feeallocations'), ['controller' => 'Feeallocations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Feeallocation'), ['controller' => 'Feeallocations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="fees view large-9 medium-8 columns content">
    <h3><?= h($fee->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($fee->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $fee->has('user') ? $this->Html->link($fee->user->username, ['controller' => 'Users', 'action' => 'view', $fee->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($fee->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($fee->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($fee->status) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Departments') ?></h4>
        <?php if (!empty($fee->departments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created Date') ?></th>
                <th scope="col"><?= __('Faculty Id') ?></th>
                <th scope="col"><?= __('Deptcode') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($fee->departments as $departments): ?>
            <tr>
                <td><?= h($departments->id) ?></td>
                <td><?= h($departments->name) ?></td>
                <td><?= h($departments->description) ?></td>
                <td><?= h($departments->created_date) ?></td>
                <td><?= h($departments->faculty_id) ?></td>
                <td><?= h($departments->deptcode) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Departments', 'action' => 'view', $departments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Departments', 'action' => 'edit', $departments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Departments', 'action' => 'delete', $departments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Feeallocations') ?></h4>
        <?php if (!empty($fee->feeallocations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Fee Id') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Startdate') ?></th>
                <th scope="col"><?= __('Enddate') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($fee->feeallocations as $feeallocations): ?>
            <tr>
                <td><?= h($feeallocations->id) ?></td>
                <td><?= h($feeallocations->fee_id) ?></td>
                <td><?= h($feeallocations->department_id) ?></td>
                <td><?= h($feeallocations->startdate) ?></td>
                <td><?= h($feeallocations->enddate) ?></td>
                <td><?= h($feeallocations->user_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Feeallocations', 'action' => 'view', $feeallocations->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Feeallocations', 'action' => 'edit', $feeallocations->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Feeallocations', 'action' => 'delete', $feeallocations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feeallocations->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
