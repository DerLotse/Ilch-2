<?php $login_method = Kohana::config('user.login_method'); ?>

<?php echo Form::open('user/login'); ?>

<p>
    <label for="<?php echo $login_method; ?>" class=""><?php echo __($login_method); ?></label><br />
    <?php echo Form::input($login_method, NULL, array('id' => $login_method, 'class' => 'text', 'style' => 'width: 98%;')); ?>
</p>

<p>
    <label for="password"><?php echo __('password'); ?></label><br />
    <input id="password" class="text" type="password" name="password" style="width: 98%;" />
<p>

<p>
    <input type="submit" value="<?php echo __('Sign in'); ?>" />
</p>

<?php echo Form::close(); ?>