<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Courier $courier
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Couriers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Trequests'), ['controller' => 'Trequests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Trequest'), ['controller' => 'Trequests', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="couriers form large-9 medium-8 columns content">
    <?= $this->Form->create($courier) ?>
    <fieldset>
        <legend><?= __('Add Courier') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
