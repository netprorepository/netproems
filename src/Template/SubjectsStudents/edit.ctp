<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SubjectsStudent $subjectsStudent
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $subjectsStudent->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $subjectsStudent->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Subjects Students'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="subjectsStudents form large-9 medium-8 columns content">
    <?= $this->Form->create($subjectsStudent) ?>
    <fieldset>
        <legend><?= __('Edit Subjects Student') ?></legend>
        <?php
            echo $this->Form->control('subject_id', ['options' => $subjects]);
            echo $this->Form->control('student_id', ['options' => $students]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
