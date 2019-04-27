<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sparent $sparent
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sparent'), ['action' => 'edit', $sparent->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sparent'), ['action' => 'delete', $sparent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sparent->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sparents'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sparent'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="sparents view large-9 medium-8 columns content">
    <h3><?= h($sparent->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Fathersname') ?></th>
            <td><?= h($sparent->fathersname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mothersname') ?></th>
            <td><?= h($sparent->mothersname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fatherphone') ?></th>
            <td><?= h($sparent->fatherphone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Motherphone') ?></th>
            <td><?= h($sparent->motherphone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fathersjob') ?></th>
            <td><?= h($sparent->fathersjob) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mothersjob') ?></th>
            <td><?= h($sparent->mothersjob) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($sparent->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pemailaddress') ?></th>
            <td><?= $this->Number->format($sparent->pemailaddress) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Students') ?></h4>
        <?php if (!empty($sparent->students)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Fname') ?></th>
                <th scope="col"><?= __('Lname') ?></th>
                <th scope="col"><?= __('Mname') ?></th>
                <th scope="col"><?= __('Dob') ?></th>
                <th scope="col"><?= __('Joindate') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Olevelresulturl') ?></th>
                <th scope="col"><?= __('Jamb') ?></th>
                <th scope="col"><?= __('Birthcerturl') ?></th>
                <th scope="col"><?= __('Othercerts') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Fathersname') ?></th>
                <th scope="col"><?= __('Mothersname') ?></th>
                <th scope="col"><?= __('Fatherphone') ?></th>
                <th scope="col"><?= __('Motherphone') ?></th>
                <th scope="col"><?= __('Fathersjob') ?></th>
                <th scope="col"><?= __('Mothersjob') ?></th>
                <th scope="col"><?= __('Passporturl') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Regno') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Admissiondate') ?></th>
                <th scope="col"><?= __('Gender') ?></th>
                <th scope="col"><?= __('Application No') ?></th>
                <th scope="col"><?= __('Level Id') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($sparent->students as $students): ?>
            <tr>
                <td><?= h($students->id) ?></td>
                <td><?= h($students->fname) ?></td>
                <td><?= h($students->lname) ?></td>
                <td><?= h($students->mname) ?></td>
                <td><?= h($students->dob) ?></td>
                <td><?= h($students->joindate) ?></td>
                <td><?= h($students->department_id) ?></td>
                <td><?= h($students->olevelresulturl) ?></td>
                <td><?= h($students->jamb) ?></td>
                <td><?= h($students->birthcerturl) ?></td>
                <td><?= h($students->othercerts) ?></td>
                <td><?= h($students->email) ?></td>
                <td><?= h($students->state_id) ?></td>
                <td><?= h($students->country_id) ?></td>
                <td><?= h($students->address) ?></td>
                <td><?= h($students->phone) ?></td>
                <td><?= h($students->fathersname) ?></td>
                <td><?= h($students->mothersname) ?></td>
                <td><?= h($students->fatherphone) ?></td>
                <td><?= h($students->motherphone) ?></td>
                <td><?= h($students->fathersjob) ?></td>
                <td><?= h($students->mothersjob) ?></td>
                <td><?= h($students->passporturl) ?></td>
                <td><?= h($students->user_id) ?></td>
                <td><?= h($students->regno) ?></td>
                <td><?= h($students->status) ?></td>
                <td><?= h($students->admissiondate) ?></td>
                <td><?= h($students->gender) ?></td>
                <td><?= h($students->application_no) ?></td>
                <td><?= h($students->level_id) ?></td>
                <td><?= h($students->parent_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Students', 'action' => 'view', $students->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Students', 'action' => 'edit', $students->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Students', 'action' => 'delete', $students->id], ['confirm' => __('Are you sure you want to delete # {0}?', $students->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
