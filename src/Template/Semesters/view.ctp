<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Semester $semester
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Semester'), ['action' => 'edit', $semester->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Semester'), ['action' => 'delete', $semester->id], ['confirm' => __('Are you sure you want to delete # {0}?', $semester->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Semesters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Semester'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Results'), ['controller' => 'Results', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Result'), ['controller' => 'Results', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="semesters view large-9 medium-8 columns content">
    <h3><?= h($semester->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($semester->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($semester->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Results') ?></h4>
        <?php if (!empty($semester->results)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Faculty Id') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Subject Id') ?></th>
                <th scope="col"><?= __('Semester Id') ?></th>
                <th scope="col"><?= __('Session Id') ?></th>
                <th scope="col"><?= __('Score') ?></th>
                <th scope="col"><?= __('Grade') ?></th>
                <th scope="col"><?= __('Remark') ?></th>
                <th scope="col"><?= __('Uploaddate') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Regno') ?></th>
                <th scope="col"><?= __('Creditload') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($semester->results as $results): ?>
            <tr>
                <td><?= h($results->id) ?></td>
                <td><?= h($results->student_id) ?></td>
                <td><?= h($results->faculty_id) ?></td>
                <td><?= h($results->department_id) ?></td>
                <td><?= h($results->subject_id) ?></td>
                <td><?= h($results->semester_id) ?></td>
                <td><?= h($results->session_id) ?></td>
                <td><?= h($results->score) ?></td>
                <td><?= h($results->grade) ?></td>
                <td><?= h($results->remark) ?></td>
                <td><?= h($results->uploaddate) ?></td>
                <td><?= h($results->user_id) ?></td>
                <td><?= h($results->regno) ?></td>
                <td><?= h($results->creditload) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Results', 'action' => 'view', $results->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Results', 'action' => 'edit', $results->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Results', 'action' => 'delete', $results->id], ['confirm' => __('Are you sure you want to delete # {0}?', $results->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
