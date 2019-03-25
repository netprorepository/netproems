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
                        <h2>Update Syatem Settings</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <?= $this->Form->create($setting,['type'=>'file']) ?>
                        <fieldset>

                            <?php
                            echo '<div class="col-md-4">';
                            echo $this->Form->control('type', ['label' => 'TYPE', 'class' => 'form-control']);
                            echo '</div>';

                            echo '<div class="col-md-4">';
                            echo $this->Form->control('description', ['label' => 'DESCRIPTION', 'class' => 'form-control']);
                            echo '</div>';

                            echo '<div class="col-md-4">';
                            echo $this->Form->control('name', ['label' => 'SYSTEM NAME', 'class' => 'form-control']);
                            echo '</div>';

                            echo '<div class="col-md-4">';
                            echo $this->Form->control('address', ['label' => 'ADDRESS', 'class' => 'form-control']);
                            echo '</div>';

                            echo '<div class="col-md-4">';
                            echo $this->Form->control('email', ['label' => 'EMAIL', 'class' => 'form-control']);
                            echo '</div>';

                            echo '<div class="col-md-4">';
                            echo $this->Form->control('phone', ['label' => 'PHONE', 'class' => 'form-control']);
                            echo '</div>';

                            echo '<div class="col-md-4">';
                            echo $this->Form->control('invoiceprefix', ['label' => 'INVOICE PREFIX', 'class' => 'form-control']);
                            echo '</div>';

                            echo '<div class="col-md-4">';
                            echo $this->Form->control('adminprefix', ['label' => 'ADMIN PREFIX', 'class' => 'form-control']);
                            echo '</div>';

                            echo '<div class="col-md-4">';
                            echo $this->Form->control('logo', ['label' => 'LOGO', 'class' => 'form-control', 'type' => 'file']);
                            echo '</div>';

                            echo '<div class="col-md-4">';
                            echo $this->Form->control('staffprefix', ['label' => 'STAFF PREFIX', 'class' => 'form-control']);
                            echo '</div>';
                            ?>

                        </fieldset>
                        <br /> <br />
<?= $this->Form->button('Submit', ['class' => 'btn btn-primary pull-right']) ?>
                        <?= $this->Form->end() ?>

                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>
</div>


