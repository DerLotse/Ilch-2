<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>Backend <?php echo $title; ?></title>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <meta name="keywords" content="<?php echo $meta_keywords; ?>" />
        <meta name="description" content="<?php echo $meta_description; ?>" />
        <meta name="copyright" content="<?php echo $meta_copywrite; ?>" />
        <?php foreach ($styles as $file => $type){echo HTML::style($file, array('media' => $type)), "\n";} ?>
        <?php foreach ($scripts as $file){echo HTML::script($file, NULL, TRUE), "\n";} ?>
    </head>
    <body>
        <?php echo $content; ?>
    </body>
</html>