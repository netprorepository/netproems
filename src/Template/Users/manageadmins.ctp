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
                        <h2>Manage Admins</h2>
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

                                        <th> NAME</th>
                                        <th>ROLE</th>
                                        <th>USERNAME</th>


                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($admins as $admin): ?>
                                        <tr>

                                            <td><?= h($admin->fname . ' ' . $admin->lname) ?></td>
                                            <td><?= h($admin->role->role_name) ?></td>
                                            <td><?= $admin->username ?></td>


                                            <td class="actions">
                                                <?= $this->Html->link(__('View'), ['action' => 'viewadmin', $admin->id, $this->GenerateUrl($admin->fname)]) ?>
                                                <?= $this->Html->link(__('Edit'), ['action' => 'updateadmin', $admin->id, $this->GenerateUrl($admin->fname)]) ?>
                                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $admin->id], ['confirm' => __('Are you sure you want to delete # {0}?', $admin->fname)]) ?>
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



