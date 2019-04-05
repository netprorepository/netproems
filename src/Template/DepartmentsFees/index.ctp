<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DepartmentsFee[]|\Cake\Collection\CollectionInterface $departmentsFees
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Departments Fee'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fees'), ['controller' => 'Fees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fee'), ['controller' => 'Fees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="departmentsFees index large-9 medium-8 columns content">
    <h3><?= __('Departments Fees') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fee_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('department_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departmentsFees as $departmentsFee): ?>
            <tr>
                <td><?= $this->Number->format($departmentsFee->id) ?></td>
                <td><?= $departmentsFee->has('fee') ? $this->Html->link($departmentsFee->fee->name, ['controller' => 'Fees', 'action' => 'view', $departmentsFee->fee->id]) : '' ?></td>
                <td><?= $departmentsFee->has('department') ? $this->Html->link($departmentsFee->department->name, ['controller' => 'Departments', 'action' => 'view', $departmentsFee->department->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $departmentsFee->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $departmentsFee->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $departmentsFee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentsFee->id)]) ?>
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
