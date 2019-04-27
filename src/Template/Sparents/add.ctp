<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sparent $sparent
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Sparents'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="sparents form large-9 medium-8 columns content">
    <?= $this->Form->create($sparent) ?>
    <fieldset>
        <legend><?= __('Add Sparent') ?></legend>
        <?php
            echo $this->Form->control('fathersname');
            echo $this->Form->control('mothersname');
            echo $this->Form->control('fatherphone');
            echo $this->Form->control('motherphone');
            echo $this->Form->control('fathersjob');
            echo $this->Form->control('mothersjob');
            echo $this->Form->control('pemailaddress');
            echo $this->Form->control('students._ids', ['options' => $students]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
