<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>
        <?php echo HTML::style('media/installation/css/reset.css'); ?>
        <?php echo HTML::style('media/installation/css/style.css'); ?>
        <?php echo HTML::script('media/js/jquery.js'); ?>
        <?PHP echo HTML::script('media/installation/js/custom.js'); ?>
    </head>
    <body>
        <div id="wrapper">
            <aside>
                <?php echo HTML::image('media/installation/images/logo.png'); ?>
                <ul>
                    <?php $steps_count = count($steps); ?>
                    <?php foreach ($steps AS $step => $name): ?>
                        <li class="<?php echo ($act_step == $step) ? 'active' : (($act_step > $step) ? 'ready' : 'normal'); ?>">
                            <?php echo ($act_step <= $step) ? '<span>&raquo</span>' : ''; echo __($name); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </aside>
            <section id="main_container">
                <?php echo Form::open(); ?>
                <header></header>
                <section id="content">
                    <article>
                        <h2><?php echo __($steps[$act_step]); ?></h2>
                        <noscript>
                            <p class="state_error">
                                <?php echo '<span>'.__('Error').':</span> '.__('Please activate javascript.'); ?>
                            </p>
                        </noscript>
                        <?php if($_POST == TRUE AND $errors == TRUE): ?>
                            <p class="state_error">
                            <?php foreach($errors AS $error): ?>
                                <?php echo $error; ?><br />
                            <?php endforeach; ?>
                            </p>
                        <?php endif; ?>
                        <?php echo $content; ?>
                    </article>
                </section>
                <footer>
                    <?php if ($act_step != ($steps_count-1)) echo Form::submit('submit', __('Next step')) ?>
                    <?php if ($act_step > 0 AND $act_step != ($steps_count-1)) echo Form::submit('backward', __('Backward'), array('step' => Url::site('installation/step'.($act_step-1)))); ?>
                    <br class="clear" />
                </footer>
                <?php echo Form::close(); ?>
            </section>
            <br class="clear" />
        </div>
    </body>
</html>