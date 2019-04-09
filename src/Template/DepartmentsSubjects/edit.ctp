<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DepartmentsSubject $departmentsSubject
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $departmentsSubject->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $departmentsSubject->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Departments Subjects'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="departmentsSubjects form large-9 medium-8 columns content">
    <?= $this->Form->create($departmentsSubject) ?>
    <fieldset>
        <legend><?= __('Edit Departments Subject') ?></legend>
        <?php
            echo $this->Form->control('department_id', ['options' => $departments]);
            echo $this->Form->control('subject_id', ['options' => $subjects]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
