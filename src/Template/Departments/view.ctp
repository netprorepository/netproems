<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Department'), ['action' => 'edit', $department->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Department'), ['action' => 'delete', $department->id], ['confirm' => __('Are you sure you want to delete # {0}?', $department->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Faculties'), ['controller' => 'Faculties', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Faculty'), ['controller' => 'Faculties', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Dstudents'), ['controller' => 'Dstudents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Dstudent'), ['controller' => 'Dstudents', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Feeallocations'), ['controller' => 'Feeallocations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Feeallocation'), ['controller' => 'Feeallocations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Programes'), ['controller' => 'Programes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Programe'), ['controller' => 'Programes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fees'), ['controller' => 'Fees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fee'), ['controller' => 'Fees', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="departments view large-9 medium-8 columns content">
    <h3><?= h($department->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($department->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($department->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Faculty') ?></th>
            <td><?= $department->has('faculty') ? $this->Html->link($department->faculty->name, ['controller' => 'Faculties', 'action' => 'view', $department->faculty->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deptcode') ?></th>
            <td><?= h($department->deptcode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($department->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created Date') ?></th>
            <td><?= h($department->created_date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Subjects') ?></h4>
        <?php if (!empty($department->subjects)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Subjectcode') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Creditload') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created Date') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->subjects as $subjects): ?>
            <tr>
                <td><?= h($subjects->id) ?></td>
                <td><?= h($subjects->name) ?></td>
                <td><?= h($subjects->subjectcode) ?></td>
                <td><?= h($subjects->department_id) ?></td>
                <td><?= h($subjects->creditload) ?></td>
                <td><?= h($subjects->user_id) ?></td>
                <td><?= h($subjects->created_date) ?></td>
                <td><?= h($subjects->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Subjects', 'action' => 'view', $subjects->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Subjects', 'action' => 'edit', $subjects->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Subjects', 'action' => 'delete', $subjects->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subjects->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Fees') ?></h4>
        <?php if (!empty($department->fees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Startdate') ?></th>
                <th scope="col"><?= __('Enddate') ?></th>
                <th scope="col"><?= __('Feetype') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->fees as $fees): ?>
            <tr>
                <td><?= h($fees->id) ?></td>
                <td><?= h($fees->name) ?></td>
                <td><?= h($fees->amount) ?></td>
                <td><?= h($fees->user_id) ?></td>
                <td><?= h($fees->status) ?></td>
                <td><?= h($fees->startdate) ?></td>
                <td><?= h($fees->enddate) ?></td>
                <td><?= h($fees->feetype) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Fees', 'action' => 'view', $fees->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Fees', 'action' => 'edit', $fees->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Fees', 'action' => 'delete', $fees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fees->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Dstudents') ?></h4>
        <?php if (!empty($department->dstudents)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Fname') ?></th>
                <th scope="col"><?= __('Lname') ?></th>
                <th scope="col"><?= __('Mname') ?></th>
                <th scope="col"><?= __('Dob') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Olevelcerturl') ?></th>
                <th scope="col"><?= __('Jambscore') ?></th>
                <th scope="col"><?= __('Birthcerturl') ?></th>
                <th scope="col"><?= __('Otherfile') ?></th>
                <th scope="col"><?= __('Fathersname') ?></th>
                <th scope="col"><?= __('Fathersphone') ?></th>
                <th scope="col"><?= __('Mothersname') ?></th>
                <th scope="col"><?= __('Mothersphone') ?></th>
                <th scope="col"><?= __('Fathersjob') ?></th>
                <th scope="col"><?= __('Mothersjob') ?></th>
                <th scope="col"><?= __('Appliedon') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Passporturl') ?></th>
                <th scope="col"><?= __('Regno') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->dstudents as $dstudents): ?>
            <tr>
                <td><?= h($dstudents->id) ?></td>
                <td><?= h($dstudents->fname) ?></td>
                <td><?= h($dstudents->lname) ?></td>
                <td><?= h($dstudents->mname) ?></td>
                <td><?= h($dstudents->dob) ?></td>
                <td><?= h($dstudents->address) ?></td>
                <td><?= h($dstudents->state_id) ?></td>
                <td><?= h($dstudents->country_id) ?></td>
                <td><?= h($dstudents->phone) ?></td>
                <td><?= h($dstudents->email) ?></td>
                <td><?= h($dstudents->user_id) ?></td>
                <td><?= h($dstudents->department_id) ?></td>
                <td><?= h($dstudents->olevelcerturl) ?></td>
                <td><?= h($dstudents->jambscore) ?></td>
                <td><?= h($dstudents->birthcerturl) ?></td>
                <td><?= h($dstudents->otherfile) ?></td>
                <td><?= h($dstudents->fathersname) ?></td>
                <td><?= h($dstudents->fathersphone) ?></td>
                <td><?= h($dstudents->mothersname) ?></td>
                <td><?= h($dstudents->mothersphone) ?></td>
                <td><?= h($dstudents->fathersjob) ?></td>
                <td><?= h($dstudents->mothersjob) ?></td>
                <td><?= h($dstudents->appliedon) ?></td>
                <td><?= h($dstudents->status) ?></td>
                <td><?= h($dstudents->passporturl) ?></td>
                <td><?= h($dstudents->regno) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Dstudents', 'action' => 'view', $dstudents->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Dstudents', 'action' => 'edit', $dstudents->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Dstudents', 'action' => 'delete', $dstudents->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dstudents->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Feeallocations') ?></h4>
        <?php if (!empty($department->feeallocations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Fee Id') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Startdate') ?></th>
                <th scope="col"><?= __('Enddate') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->feeallocations as $feeallocations): ?>
            <tr>
                <td><?= h($feeallocations->id) ?></td>
                <td><?= h($feeallocations->fee_id) ?></td>
                <td><?= h($feeallocations->department_id) ?></td>
                <td><?= h($feeallocations->startdate) ?></td>
                <td><?= h($feeallocations->enddate) ?></td>
                <td><?= h($feeallocations->user_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Feeallocations', 'action' => 'view', $feeallocations->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Feeallocations', 'action' => 'edit', $feeallocations->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Feeallocations', 'action' => 'delete', $feeallocations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feeallocations->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Programes') ?></h4>
        <?php if (!empty($department->programes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Programecode') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->programes as $programes): ?>
            <tr>
                <td><?= h($programes->id) ?></td>
                <td><?= h($programes->department_id) ?></td>
                <td><?= h($programes->programecode) ?></td>
                <td><?= h($programes->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Programes', 'action' => 'view', $programes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Programes', 'action' => 'edit', $programes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Programes', 'action' => 'delete', $programes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $programes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Students') ?></h4>
        <?php if (!empty($department->students)): ?>
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
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->students as $students): ?>
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
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($department->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Role Id') ?></th>
                <th scope="col"><?= __('Fname') ?></th>
                <th scope="col"><?= __('Lname') ?></th>
                <th scope="col"><?= __('Mname') ?></th>
                <th scope="col"><?= __('Gender') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Country Id') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Profile') ?></th>
                <th scope="col"><?= __('Dob') ?></th>
                <th scope="col"><?= __('Created Date') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Passport') ?></th>
                <th scope="col"><?= __('Useruniquid') ?></th>
                <th scope="col"><?= __('Userstatus') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->username) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->role_id) ?></td>
                <td><?= h($users->fname) ?></td>
                <td><?= h($users->lname) ?></td>
                <td><?= h($users->mname) ?></td>
                <td><?= h($users->gender) ?></td>
                <td><?= h($users->address) ?></td>
                <td><?= h($users->country_id) ?></td>
                <td><?= h($users->state_id) ?></td>
                <td><?= h($users->phone) ?></td>
                <td><?= h($users->department_id) ?></td>
                <td><?= h($users->profile) ?></td>
                <td><?= h($users->dob) ?></td>
                <td><?= h($users->created_date) ?></td>
                <td><?= h($users->created_by) ?></td>
                <td><?= h($users->passport) ?></td>
                <td><?= h($users->useruniquid) ?></td>
                <td><?= h($users->userstatus) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
