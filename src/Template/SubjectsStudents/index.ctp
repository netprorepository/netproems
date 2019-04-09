<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SubjectsStudent[]|\Cake\Collection\CollectionInterface $subjectsStudents
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Subjects Student'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="subjectsStudents index large-9 medium-8 columns content">
    <h3><?= __('Subjects Students') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subject_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('student_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subjectsStudents as $subjectsStudent): ?>
            <tr>
                <td><?= $this->Number->format($subjectsStudent->id) ?></td>
                <td><?= $subjectsStudent->has('subject') ? $this->Html->link($subjectsStudent->subject->name, ['controller' => 'Subjects', 'action' => 'view', $subjectsStudent->subject->id]) : '' ?></td>
                <td><?= $subjectsStudent->has('student') ? $this->Html->link($subjectsStudent->student->id, ['controller' => 'Students', 'action' => 'view', $subjectsStudent->student->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $subjectsStudent->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $subjectsStudent->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $subjectsStudent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subjectsStudent->id)]) ?>
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
