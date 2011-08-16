<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="language"]').change(function(){
            $(location).attr('href', '<?php echo Url::site('installation/step0'); ?>/'+$(this).val());
        });
    });
</script>

<p class="state_warning">
    <?php echo __('alpha_caution'); ?>
</p>

<p>
    <?php echo __('step0_help'); ?>
</p>

<p class="form">
    <?php echo Form::label('language', __('Choose a language')); ?>
    <?php echo Form::select('language', $languages, I18n::lang()); ?>
    <br class="clear" />
</p>