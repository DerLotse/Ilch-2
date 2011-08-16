<p>
    <?php echo __('step4_help'); ?>
</p>

<p class="form">
    <?php echo Form::label('database_driver', __('Database Driver')); ?>
    <?php echo Form::select('database_driver', $database_drivers, Arr::get($data_step4, 'database_driver')); ?>
    <br class="clear" />
</p>

<p class="form pdo">
    <?php echo Form::label('pdo_driver', __('PDO Driver')); ?>
    <?php echo Form::select('pdo_driver', $pdo_drivers, Arr::get($data_step4, 'pdo_driver')); ?>
    <br class="clear" />
</p>

<p class="form database_own_dsn">
    <?php echo Form::label('database_own_dsn', __('Database DSN')); ?>
    <?php echo Form::input('database_own_dsn', Arr::get($data_step4, 'database_own_dsn'), array('placeholder' => __('Example').': mysql:host=localhost;dbname=ilchcms2x')); ?>
    <br class="clear" />
</p>

<p class="form database_host">
    <?php echo Form::label('database_host', __('Database Host')); ?>
    <?php echo Form::input('database_host', Arr::get($data_step4, 'database_host'), array('placeholder' => 'localhost')); ?>
    <br class="clear" />
</p>

<p class="form database_port">
    <?php echo Form::label('database_port', __('Database Port')); ?>
    <?php echo Form::input('database_port', Arr::get($data_step4, 'database_port'), array('placeholder' => __('Leave empty for default'))); ?>
    <br class="clear" />
</p>

<p class="form database_name">
    <?php echo Form::label('database_name', __('Database Name')); ?>
    <?php echo Form::input('database_name', Arr::get($data_step4, 'database_name')); ?>
    <br class="clear" />
</p>

<p class="form">
    <?php echo Form::label('database_user', __('Database User')); ?>
    <?php echo Form::input('database_user', Arr::get($data_step4, 'database_user')); ?>
    <br class="clear" />
</p>

<p class="form">
    <?php echo Form::label('database_password', __('Database Password')); ?>
    <?php echo Form::password('database_password'); ?>
    <br class="clear" />
</p>

<p class="form">
    <?php echo Form::label('database_prefix', __('Database Table-Prefix')); ?>
    <?php echo Form::input('database_prefix', Arr::get($data_step4, 'database_prefix'), array('placeholder' => __('Example').': ic1_')); ?>
    <br class="clear" />
</p>