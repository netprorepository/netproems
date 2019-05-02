<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coursematerial[]|\Cake\Collection\CollectionInterface $coursematerials
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Coursematerial'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teachers'), ['controller' => 'Teachers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Teacher'), ['controller' => 'Teachers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="coursematerials index large-9 medium-8 columns content">
    <h3><?= __('Coursematerials') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subject_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('teacher_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fileurl') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('department_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('comment') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($coursematerials as $coursematerial): ?>
            <tr>
                <td><?= $this->Number->format($coursematerial->id) ?></td>
                <td><?= $coursematerial->has('subject') ? $this->Html->link($coursematerial->subject->name, ['controller' => 'Subjects', 'action' => 'view', $coursematerial->subject->id]) : '' ?></td>
                <td><?= $coursematerial->has('teacher') ? $this->Html->link($coursematerial->teacher->firstname, ['controller' => 'Teachers', 'action' => 'view', $coursematerial->teacher->id]) : '' ?></td>
                <td><?= h($coursematerial->title) ?></td>
                <td><?= h($coursematerial->fileurl) ?></td>
                <td><?= h($coursematerial->date_created) ?></td>
                <td><?= $coursematerial->has('department') ? $this->Html->link($coursematerial->department->name, ['controller' => 'Departments', 'action' => 'view', $coursematerial->department->id]) : '' ?></td>
                <td><?= h($coursematerial->comment) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $coursematerial->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $coursematerial->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $coursematerial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coursematerial->id)]) ?>
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
