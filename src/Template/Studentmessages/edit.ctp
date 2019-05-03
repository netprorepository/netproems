<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Studentmessage $studentmessage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $studentmessage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $studentmessage->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Studentmessages'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="studentmessages form large-9 medium-8 columns content">
    <?= $this->Form->create($studentmessage) ?>
    <fieldset>
        <legend><?= __('Edit Studentmessage') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('messages');
            echo $this->Form->control('student_id', ['options' => $students]);
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('date_created');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
