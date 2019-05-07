<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Trequest $trequest
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Trequests'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Continents'), ['controller' => 'Continents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Continent'), ['controller' => 'Continents', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Couriers'), ['controller' => 'Couriers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Courier'), ['controller' => 'Couriers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="trequests form large-9 medium-8 columns content">
    <?= $this->Form->create($trequest) ?>
    <fieldset>
        <legend><?= __('Add Trequest') ?></legend>
        <?php
            echo $this->Form->control('student_id', ['options' => $students]);
            echo $this->Form->control('orderdate');
            echo $this->Form->control('institution');
            echo $this->Form->control('status');
            echo $this->Form->control('continent_id', ['options' => $continents]);
            echo $this->Form->control('country_id', ['options' => $countries]);
            echo $this->Form->control('state_id', ['options' => $states]);
            echo $this->Form->control('address');
            echo $this->Form->control('courier_id', ['options' => $couriers]);
            echo $this->Form->control('amount');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
