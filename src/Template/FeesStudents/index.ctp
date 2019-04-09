<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FeesStudent[]|\Cake\Collection\CollectionInterface $feesStudents
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Fees Student'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fees'), ['controller' => 'Fees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fee'), ['controller' => 'Fees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="feesStudents index large-9 medium-8 columns content">
    <h3><?= __('Fees Students') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fee_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('student_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($feesStudents as $feesStudent): ?>
            <tr>
                <td><?= $this->Number->format($feesStudent->id) ?></td>
                <td><?= $feesStudent->has('fee') ? $this->Html->link($feesStudent->fee->name, ['controller' => 'Fees', 'action' => 'view', $feesStudent->fee->id]) : '' ?></td>
                <td><?= $feesStudent->has('student') ? $this->Html->link($feesStudent->student->id, ['controller' => 'Students', 'action' => 'view', $feesStudent->student->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $feesStudent->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $feesStudent->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $feesStudent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feesStudent->id)]) ?>
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
