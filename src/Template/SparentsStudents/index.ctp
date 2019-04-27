<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SparentsStudent[]|\Cake\Collection\CollectionInterface $sparentsStudents
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sparents Student'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="sparentsStudents index large-9 medium-8 columns content">
    <h3><?= __('Sparents Students') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('student_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('parent_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sparentsStudents as $sparentsStudent): ?>
            <tr>
                <td><?= $this->Number->format($sparentsStudent->id) ?></td>
                <td><?= $sparentsStudent->has('student') ? $this->Html->link($sparentsStudent->student->fname, ['controller' => 'Students', 'action' => 'view', $sparentsStudent->student->id]) : '' ?></td>
                <td><?= $sparentsStudent->has('parent_sparents_student') ? $this->Html->link($sparentsStudent->parent_sparents_student->id, ['controller' => 'SparentsStudents', 'action' => 'view', $sparentsStudent->parent_sparents_student->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $sparentsStudent->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $sparentsStudent->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $sparentsStudent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sparentsStudent->id)]) ?>
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
