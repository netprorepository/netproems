<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Constant $constant
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Constants'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="constants form large-9 medium-8 columns content">
    <?= $this->Form->create($constant) ?>
    <fieldset>
        <legend><?= __('Add Constant') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('value');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
