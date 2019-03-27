<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Setting $setting
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Settings'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="settings form large-9 medium-8 columns content">
    <?= $this->Form->create($setting) ?>
    <fieldset>
        <legend><?= __('Add Setting') ?></legend>
        <?php
            echo $this->Form->control('type');
            echo $this->Form->control('description');
            echo $this->Form->control('regfee');
            echo $this->Form->control('name');
            echo $this->Form->control('address');
            echo $this->Form->control('email');
            echo $this->Form->control('phone');
            echo $this->Form->control('invoiceprefix');
            echo $this->Form->control('adminprefix');
            echo $this->Form->control('logo');
            echo $this->Form->control('staffprefix');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
