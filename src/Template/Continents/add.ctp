<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Continent $continent
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Continents'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Trequests'), ['controller' => 'Trequests', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Trequest'), ['controller' => 'Trequests', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="continents form large-9 medium-8 columns content">
    <?= $this->Form->create($continent) ?>
    <fieldset>
        <legend><?= __('Add Continent') ?></legend>
        <?php
            echo $this->Form->control('code');
            echo $this->Form->control('name');
            echo $this->Form->control('cost');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
