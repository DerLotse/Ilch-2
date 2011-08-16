<p>
	<?php echo __('step5_help'); ?>
</p>

<p class="form">
	<?php echo Form::label('hash_method', __('Hash Algorithmus')); ?>
	<?php echo Form::select('hash_method', $hash_algos, Arr::get($data_step5, 'hash_method', 'md5_ilch')); ?>
    <br class="clear" />
</p>

<h4><?php echo __('Your first account'); ?></h4>

<p>
	<?php echo __('step5_help_user'); ?>
</p>

<p class="form">
	<?php echo Form::label('user_login', __('user login')); ?>
	<?php echo Form::input('user_login', Arr::get($data_step5, 'user_login'), array('placeholder' => __('Do you need to login'))); ?>
    <br class="clear" />
</p>
<p class="form">
	<?php echo Form::label('user_nickname', __('user nickname')); ?>
	<?php echo Form::input('user_nickname', Arr::get($data_step5, 'user_nickname'), array('placeholder' => __('This name is visible for the public'))); ?>
    <br class="clear" />
</p>
<p class="form">
	<?php echo Form::label('user_email', __('user email')); ?>
	<?php echo Form::input('user_email', Arr::get($data_step5, 'user_email')); ?>
    <br class="clear" />
</p>
<p class="form">
	<?php echo Form::label('user_password', __('user password')); ?>
	<?php echo Form::password('user_password'); ?>
    <br class="clear" />
</p>
<p class="form">
	<?php echo Form::label('user_password_confirm', __('user password confirm')); ?>
	<?php echo Form::password('user_password_confirm'); ?>
    <br class="clear" />
</p>