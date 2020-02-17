<div class="users form">

    <div class="row">
        <div class="col-md-12">
            <div class="page-header text-center">
                <h1><?php echo __('Login'); ?></h1>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-3">
            <!--            <div class="actions">-->
            <!--                <div class="panel panel-default">-->
            <!--                    <div class="panel-heading">--><?php //echo __('Actions'); ?><!--</div>-->
            <!--                    <div class="panel-body">-->
            <!--                        <ul class="nav nav-pills nav-stacked">-->
            <!---->
            <!--                            <li>-->
            <?php //echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;' . __('List Users'), array('action' => 'index'), array('escape' => false)); ?><!--</li>-->
            <!--                        </ul>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
        </div><!-- end col md 3 -->
        <div class="col-md-6">
            <div class="text-center">
                <p><?= $this->Session->flash(); ?></p><br>
            </div>

            <fieldset>
                <legend class="text-center"><?= __('Please enter your username and password') ?></legend>
                <?php echo $this->Form->create('User', array('role' => 'form')); ?>

                <div class="form-group">
                    <?php echo $this->Form->input('username', array('class' => 'form-control', 'placeholder' => 'Username')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Password')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->submit(__('Login'), array('class' => 'btn btn-default')); ?>
                </div>
                <p>Don't have an account? <?= $this->Html->link(
                        'sign up',
                        '/users/signup',
                        array('class' => 'button')
                    ); ?>
                </p>
            </fieldset>

            <?php echo $this->Form->end() ?>

        </div><!-- end col md 12 -->
    </div><!-- end row -->
</div>
