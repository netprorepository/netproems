<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DepartmentsSubject[]|\Cake\Collection\CollectionInterface $departmentsSubjects
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Departments Subject'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="departmentsSubjects index large-9 medium-8 columns content">
    <h3><?= __('Departments Subjects') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('department_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subject_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departmentsSubjects as $departmentsSubject): ?>
            <tr>
                <td><?= $this->Number->format($departmentsSubject->id) ?></td>
                <td><?= $departmentsSubject->has('department') ? $this->Html->link($departmentsSubject->department->name, ['controller' => 'Departments', 'action' => 'view', $departmentsSubject->department->id]) : '' ?></td>
                <td><?= $departmentsSubject->has('subject') ? $this->Html->link($departmentsSubject->subject->name, ['controller' => 'Subjects', 'action' => 'view', $departmentsSubject->subject->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $departmentsSubject->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $departmentsSubject->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $departmentsSubject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentsSubject->id)]) ?>
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
