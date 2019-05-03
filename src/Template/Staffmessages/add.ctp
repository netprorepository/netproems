<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Staffmessage $staffmessage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Staffmessages'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Teachers'), ['controller' => 'Teachers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Teacher'), ['controller' => 'Teachers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="staffmessages form large-9 medium-8 columns content">
    <?= $this->Form->create($staffmessage) ?>
    <fieldset>
        <legend><?= __('Add Staffmessage') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('message');
            echo $this->Form->control('datecreated');
            echo $this->Form->control('teacher_id', ['options' => $teachers]);
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
