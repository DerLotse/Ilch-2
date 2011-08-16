<p>
    <?php echo __('step2_help'); ?>
</p>

<p class="form">
    <?php echo Form::label('application_directory', __('Application directory')); ?>
    <?php echo Form::select('application_directory', $directories, Arr::get($data_step2, 'application_directory')); ?>
    <br class="clear" />
</p>