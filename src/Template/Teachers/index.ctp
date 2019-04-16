<<<<<<< HEAD
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Teacher[]|\Cake\Collection\CollectionInterface $teachers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Teacher'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?></li>

        <li><?= $this->Html->link(__('List Subject Teachers'), ['controller' => 'SubjectTeachers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject Teacher'), ['controller' => 'SubjectTeachers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="teachers index large-9 medium-8 columns content">
    <h3><?= __('Teachers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gender') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('profile') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cv') ?></th>
                <th scope="col"><?= $this->Paginator->sort('qualification') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teachers as $teacher): ?>
            <tr>
                <td><?= $this->Number->format($teacher->id) ?></td>
                <td><?= $teacher->has('user') ? $this->Html->link($teacher->user->id, ['controller' => 'Users', 'action' => 'view', $teacher->user->id]) : '' ?></td>
                <td><?= h($teacher->gender) ?></td>
                <td><?= h($teacher->address) ?></td>
                <td><?= $teacher->has('country') ? $this->Html->link($teacher->country->name, ['controller' => 'Countries', 'action' => 'view', $teacher->country->id]) : '' ?></td>
                <td><?= $teacher->has('state') ? $this->Html->link($teacher->state->name, ['controller' => 'States', 'action' => 'view', $teacher->state->id]) : '' ?></td>
                <td><?= h($teacher->phone) ?></td>
                <td><?= h($teacher->profile) ?></td>
                <td><?= h($teacher->cv) ?></td>
                <td><?= h($teacher->qualification) ?></td>
                <td><?= h($teacher->date_created) ?></td>
                <td><?= h($teacher->passport) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $teacher->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $teacher->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $teacher->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teacher->id)]) ?>
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
=======
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Teacher[]|\Cake\Collection\CollectionInterface $teachers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Teacher'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?></li>

        <li><?= $this->Html->link(__('List Subject Teachers'), ['controller' => 'SubjectTeachers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject Teacher'), ['controller' => 'SubjectTeachers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="teachers index large-9 medium-8 columns content">
    <h3><?= __('Teachers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gender') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('profile') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cv') ?></th>
                <th scope="col"><?= $this->Paginator->sort('qualification') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teachers as $teacher): ?>
            <tr>
                <td><?= $this->Number->format($teacher->id) ?></td>
                <td><?= $teacher->has('user') ? $this->Html->link($teacher->user->id, ['controller' => 'Users', 'action' => 'view', $teacher->user->id]) : '' ?></td>
                <td><?= h($teacher->gender) ?></td>
                <td><?= h($teacher->address) ?></td>
                <td><?= $teacher->has('country') ? $this->Html->link($teacher->country->name, ['controller' => 'Countries', 'action' => 'view', $teacher->country->id]) : '' ?></td>
                <td><?= $teacher->has('state') ? $this->Html->link($teacher->state->name, ['controller' => 'States', 'action' => 'view', $teacher->state->id]) : '' ?></td>
                <td><?= h($teacher->phone) ?></td>
                <td><?= h($teacher->profile) ?></td>
                <td><?= h($teacher->cv) ?></td>
                <td><?= h($teacher->qualification) ?></td>
                <td><?= h($teacher->date_created) ?></td>
                <td><?= h($teacher->passport) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $teacher->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $teacher->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $teacher->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teacher->id)]) ?>
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
>>>>>>> origin/dev1
