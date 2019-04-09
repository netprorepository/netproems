
<div class="subjects view large-9 medium-8 columns content">
    <h3><?= h($subject->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row" style="padding: 10px;"><?= __('Name') ?></th>
            <td><?= h($subject->name) ?></td>
        </tr>
        <tr>
            <th scope="row" style="padding: 10px;"><?= __('Subject Code') ?></th>
            <td><?= h($subject->subjectcode) ?></td>
        </tr>
        <tr>
            <th scope="row" style="padding: 10px;"><?= __('Department') ?></th>
            <td><?= $subject->has('department') ? $this->Html->link($subject->department->name, ['controller' => 'Departments', 'action' => 'viewdepartment', $subject->department->id,$subject->department->name]) : '' ?></td>
        </tr>
<!--        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $subject->has('user') ? $this->Html->link($subject->user->username, ['controller' => 'Users', 'action' => 'view', $subject->user->id]) : '' ?></td>
        </tr>-->
       
        <tr>
            <th scope="row" style="padding: 10px;"><?= __('Credit Load') ?></th>
            <td><?= $this->Number->format($subject->creditload) ?></td>
        </tr>
      
<!--        <tr>
            <th scope="row"><?= __('Created Date') ?></th>
            <td><?= h($subject->created_date) ?></td>
        </tr>-->
    </table>
    <div class="related">
        <h4><?= __('Subject Teacher(s)') ?></h4>
        <?php if (!empty($subject->teachers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
              
                <th style="padding: 10px;">Teacher</th>
                <th style="padding: 10px;">Email Address</th>
                <th style="padding: 10px;">Qualification</th>
               
<!--                <th scope="col" class="actions"><?= __('Actions') ?></th>-->
            </tr>
            <?php foreach ($subject->teachers as $subjectTeachers): ?>
            <tr>
               
                <td style="padding: 10px;"><?= h($subjectTeachers->user->fname) ?></td>
                <td style="padding: 10px;"><?= h($subjectTeachers->user->username) ?></td>
                <td style="padding: 10px;"><?= h($subjectTeachers->qualification) ?></td>
                <td><?= h($subjectTeachers->created_date) ?></td>
<!--                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SubjectTeachers', 'action' => 'view', $subjectTeachers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SubjectTeachers', 'action' => 'edit', $subjectTeachers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SubjectTeachers', 'action' => 'delete', $subjectTeachers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subjectTeachers->id)]) ?>
                </td>-->
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
