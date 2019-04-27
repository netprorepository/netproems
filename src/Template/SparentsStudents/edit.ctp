<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SparentsStudent $sparentsStudent
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $sparentsStudent->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $sparentsStudent->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Sparents Students'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Parent Sparents Students'), ['controller' => 'SparentsStudents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parent Sparents Student'), ['controller' => 'SparentsStudents', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="sparentsStudents form large-9 medium-8 columns content">
    <?= $this->Form->create($sparentsStudent) ?>
    <fieldset>
        <legend><?= __('Edit Sparents Student') ?></legend>
        <?php
            echo $this->Form->control('student_id', ['options' => $students]);
            echo $this->Form->control('parent_id', ['options' => $parentSparentsStudents]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
