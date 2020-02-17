<div class="users form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header text-center">
				<h1><?php echo __('Sign Up'); ?></h1>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="col-md-3">
<!--			<div class="actions">-->
<!--				<div class="panel panel-default">-->
<!--					<div class="panel-heading">--><?php //echo __('Actions'); ?><!--</div>-->
<!--						<div class="panel-body">-->
<!--							<ul class="nav nav-pills nav-stacked">-->
<!---->
<!--																<li>--><?php //echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;'.__('List Users'), array('action' => 'index'), array('escape' => false)); ?><!--</li>-->
<!--														</ul>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>			-->
		</div><!-- end col md 3 -->
		<div class="col-md-6">

			<fieldset>
				<legend class="text-center"><?= __('Register as an author or a reader') ?></legend>
			<?php echo $this->Form->create('User', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('username', array('class' => 'form-control', 'placeholder' => 'Username'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Password'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('role', array('class' => 'form-control', 'placeholder' => 'Role','label' => 'Sign up as','empty' => 'Please select a role','options' => array('reader' => 'Reader', 'author' => 'Author')));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>
				<p>Already have an account? <?= $this->Html->link(
						'login',
						'/users/login',
						array('class' => 'button')
					); ?>
				</p>
			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
