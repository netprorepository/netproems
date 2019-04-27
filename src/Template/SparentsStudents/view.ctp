<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SparentsStudent $sparentsStudent
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sparents Student'), ['action' => 'edit', $sparentsStudent->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sparents Student'), ['action' => 'delete', $sparentsStudent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sparentsStudent->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sparents Students'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sparents Student'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parent Sparents Students'), ['controller' => 'SparentsStudents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Sparents Student'), ['controller' => 'SparentsStudents', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Child Sparents Students'), ['controller' => 'SparentsStudents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Child Sparents Student'), ['controller' => 'SparentsStudents', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="sparentsStudents view large-9 medium-8 columns content">
    <h3><?= h($sparentsStudent->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Student') ?></th>
            <td><?= $sparentsStudent->has('student') ? $this->Html->link($sparentsStudent->student->fname, ['controller' => 'Students', 'action' => 'view', $sparentsStudent->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Sparents Student') ?></th>
            <td><?= $sparentsStudent->has('parent_sparents_student') ? $this->Html->link($sparentsStudent->parent_sparents_student->id, ['controller' => 'SparentsStudents', 'action' => 'view', $sparentsStudent->parent_sparents_student->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($sparentsStudent->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Sparents Students') ?></h4>
        <?php if (!empty($sparentsStudent->child_sparents_students)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Student Id') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($sparentsStudent->child_sparents_students as $childSparentsStudents): ?>
            <tr>
                <td><?= h($childSparentsStudents->id) ?></td>
                <td><?= h($childSparentsStudents->student_id) ?></td>
                <td><?= h($childSparentsStudents->parent_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SparentsStudents', 'action' => 'view', $childSparentsStudents->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SparentsStudents', 'action' => 'edit', $childSparentsStudents->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SparentsStudents', 'action' => 'delete', $childSparentsStudents->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childSparentsStudents->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
