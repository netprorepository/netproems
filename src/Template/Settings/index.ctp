<?php
$userdata = $this->request->getSession()->read('usersinfo');
$userrole = $this->request->getSession()->read('usersroles');
?>
<div class="right_col" role="main" style="margin-bottom: 55px;">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><small></small></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage Settings</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-9 col-xs-12">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%"
                                   style="margin-top: 23px;">
                                <thead><?= $this->Flash->render() ?>
                                    <tr>
                                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('regfee') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('invoiceprefix') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('adminprefix') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('logo') ?></th>
                                        <th scope="col"><?= $this->Paginator->sort('staffprefix') ?></th>
                                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($settings as $setting): ?>
                                        <tr>
                                            <td><?= $this->Number->format($setting->id) ?></td>
                                            <td><?= h($setting->type) ?></td>
                                            <td><?= h($setting->description) ?></td>
                                            <td><?= $this->Number->format($setting->regfee) ?></td>
                                            <td><?= h($setting->name) ?></td>
                                            <td><?= h($setting->address) ?></td>
                                            <td><?= h($setting->email) ?></td>
                                            <td><?= h($setting->phone) ?></td>
                                            <td><?= h($setting->invoiceprefix) ?></td>
                                            <td><?= h($setting->adminprefix) ?></td>
                                            <td><?=
                                                $this->Html->image($setting->logo, ['alt' => 'EMS', 'class' => 'img-circle profile_img',
                                                    'style' => 'width:50px;height:60px;padding: 5px;'])
                                                ?>
                                            </td>
                                            <td><?= h($setting->staffprefix) ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link(__('View'), ['action' => 'view', $setting->id]) ?>
                                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $setting->id]) ?>
    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $setting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $setting->id)]) ?>
                                            </td>
                                        </tr>
<?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
<?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
</div>
</div>
