
<div class="feeallocations view large-9 medium-8 columns content">
   
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Fee') ?></th>
            <td><?= $feeallocation->has('fee') ? $this->Html->link($feeallocation->fee->name, ['controller' => 'Fees', 'action' => 'viewfee', $feeallocation->fee->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $feeallocation->has('department') ? $this->Html->link($feeallocation->department->name, ['controller' => 'Departments', 'action' => 'viewdepartment', $feeallocation->department->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Startdate') ?></th>
            <td><?= h($feeallocation->startdate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Enddate') ?></th>
            <td><?= h($feeallocation->enddate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Allocated By') ?></th>
            <td><?= $feeallocation->has('user') ? $this->Html->link($feeallocation->user->username, ['controller' => 'Users', 'action' => 'view', $feeallocation->user->id]) : '' ?></td>
        </tr>
        
    </table>
</div>
