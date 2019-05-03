<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Studentmessage[]|\Cake\Collection\CollectionInterface $studentmessages
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Studentmessage'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="studentmessages index large-9 medium-8 columns content">
    <h3><?= __('Studentmessages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('messages') ?></th>
                <th scope="col"><?= $this->Paginator->sort('student_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($studentmessages as $studentmessage): ?>
            <tr>
                <td><?= $this->Number->format($studentmessage->id) ?></td>
                <td><?= h($studentmessage->title) ?></td>
                <td><?= h($studentmessage->messages) ?></td>
                <td><?= $studentmessage->has('student') ? $this->Html->link($studentmessage->student->fname, ['controller' => 'Students', 'action' => 'view', $studentmessage->student->id]) : '' ?></td>
                <td><?= $studentmessage->has('user') ? $this->Html->link($studentmessage->user->username, ['controller' => 'Users', 'action' => 'view', $studentmessage->user->id]) : '' ?></td>
                <td><?= h($studentmessage->date_created) ?></td>
                <td><?= h($studentmessage->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $studentmessage->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $studentmessage->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $studentmessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentmessage->id)]) ?>
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
