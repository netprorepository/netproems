<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coursematerial $coursematerial
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $coursematerial->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $coursematerial->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Coursematerials'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teachers'), ['controller' => 'Teachers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Teacher'), ['controller' => 'Teachers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="coursematerials form large-9 medium-8 columns content">
    <?= $this->Form->create($coursematerial) ?>
    <fieldset>
        <legend><?= __('Edit Coursematerial') ?></legend>
        <?php
            echo $this->Form->control('subject_id', ['options' => $subjects]);
            echo $this->Form->control('teacher_id', ['options' => $teachers]);
            echo $this->Form->control('title');
            echo $this->Form->control('fileurl');
            echo $this->Form->control('date_created');
            echo $this->Form->control('department_id', ['options' => $departments]);
            echo $this->Form->control('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
