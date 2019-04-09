<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FeesStudent $feesStudent
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fees Student'), ['action' => 'edit', $feesStudent->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fees Student'), ['action' => 'delete', $feesStudent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feesStudent->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Fees Students'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fees Student'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fees'), ['controller' => 'Fees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fee'), ['controller' => 'Fees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="feesStudents view large-9 medium-8 columns content">
    <h3><?= h($feesStudent->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Fee') ?></th>
            <td><?= $feesStudent->has('fee') ? $this->Html->link($feesStudent->fee->name, ['controller' => 'Fees', 'action' => 'view', $feesStudent->fee->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Student') ?></th>
            <td><?= $feesStudent->has('student') ? $this->Html->link($feesStudent->student->id, ['controller' => 'Students', 'action' => 'view', $feesStudent->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($feesStudent->id) ?></td>
        </tr>
    </table>
</div>
