<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Teacher $teacher
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Teacher'), ['action' => 'edit', $teacher->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Teacher'), ['action' => 'delete', $teacher->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teacher->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Teachers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teacher'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subject Teachers'), ['controller' => 'SubjectTeachers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject Teacher'), ['controller' => 'SubjectTeachers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="teachers view large-9 medium-8 columns content">
    <h3><?= h($teacher->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $teacher->has('user') ? $this->Html->link($teacher->user->id, ['controller' => 'Users', 'action' => 'view', $teacher->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gender') ?></th>
            <td><?= h($teacher->gender) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($teacher->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= $teacher->has('country') ? $this->Html->link($teacher->country->name, ['controller' => 'Countries', 'action' => 'view', $teacher->country->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= $teacher->has('state') ? $this->Html->link($teacher->state->name, ['controller' => 'States', 'action' => 'view', $teacher->state->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($teacher->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Profile') ?></th>
            <td><?= h($teacher->profile) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cv') ?></th>
            <td><?= h($teacher->cv) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Qualification') ?></th>
            <td><?= h($teacher->qualification) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($teacher->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Created') ?></th>
            <td><?= h($teacher->date_created) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Subject Teachers') ?></h4>
        <?php if (!empty($teacher->subject_teachers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Teacher Id') ?></th>
                <th scope="col"><?= __('Subject Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created Date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($teacher->subject_teachers as $subjectTeachers): ?>
            <tr>
                <td><?= h($subjectTeachers->id) ?></td>
                <td><?= h($subjectTeachers->teacher_id) ?></td>
                <td><?= h($subjectTeachers->subject_id) ?></td>
                <td><?= h($subjectTeachers->user_id) ?></td>
                <td><?= h($subjectTeachers->created_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SubjectTeachers', 'action' => 'view', $subjectTeachers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SubjectTeachers', 'action' => 'edit', $subjectTeachers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SubjectTeachers', 'action' => 'delete', $subjectTeachers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subjectTeachers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
