<?php echo Form::open('user/login', array('class' => 'form')); ?>

<?php if ($_POST) : ?>
    <div class="error">
        <?php foreach ($errors AS $error) : ?>
            &middot; <?php echo $error; ?><br />
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<fieldset>

    <legend><?php echo __('Sign in'); ?></legend>

    <p>
        <label for="<?php echo $login_method; ?>" class=""><?php echo __($login_method); ?></label><br />
        <?php echo Form::input($login_method, Arr::get($values, $login_method), array('id' => $login_method, 'class' => 'text')); ?>
    </p>

    <p>
        <label for="password"><?php echo __('password'); ?></label><br />
        <input id="password" class="text" type="password" name="password" />
    <p>

    <p>
        <input type="submit" value="<?php echo __('Sign in'); ?>" />
    </p>

</fieldset>

<?php echo Form::close(); ?>