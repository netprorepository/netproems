<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Constant $constant
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $constant->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $constant->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Constants'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="constants form large-9 medium-8 columns content">
    <?= $this->Form->create($constant) ?>
    <fieldset>
        <legend><?= __('Edit Constant') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('value');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
