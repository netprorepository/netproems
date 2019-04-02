<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SubjectTeacher[]|\Cake\Collection\CollectionInterface $subjectTeachers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Subject Teacher'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teachers'), ['controller' => 'Teachers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Teacher'), ['controller' => 'Teachers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="subjectTeachers index large-9 medium-8 columns content">
    <h3><?= __('Subject Teachers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('teacher_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subject_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subjectTeachers as $subjectTeacher): ?>
            <tr>
                <td><?= $this->Number->format($subjectTeacher->id) ?></td>
                <td><?= $subjectTeacher->has('teacher') ? $this->Html->link($subjectTeacher->teacher->id, ['controller' => 'Teachers', 'action' => 'view', $subjectTeacher->teacher->id]) : '' ?></td>
                <td><?= $subjectTeacher->has('subject') ? $this->Html->link($subjectTeacher->subject->name, ['controller' => 'Subjects', 'action' => 'view', $subjectTeacher->subject->id]) : '' ?></td>
                <td><?= $subjectTeacher->has('user') ? $this->Html->link($subjectTeacher->user->id, ['controller' => 'Users', 'action' => 'view', $subjectTeacher->user->id]) : '' ?></td>
                <td><?= h($subjectTeacher->created_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $subjectTeacher->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $subjectTeacher->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $subjectTeacher->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subjectTeacher->id)]) ?>
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
