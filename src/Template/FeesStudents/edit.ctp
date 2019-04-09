<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FeesStudent $feesStudent
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $feesStudent->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $feesStudent->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Fees Students'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Fees'), ['controller' => 'Fees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fee'), ['controller' => 'Fees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="feesStudents form large-9 medium-8 columns content">
    <?= $this->Form->create($feesStudent) ?>
    <fieldset>
        <legend><?= __('Edit Fees Student') ?></legend>
        <?php
            echo $this->Form->control('fee_id', ['options' => $fees]);
            echo $this->Form->control('student_id', ['options' => $students]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
