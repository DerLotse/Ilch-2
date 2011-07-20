<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Ilch CMS 2.X - Backend - <?php echo $title; ?></title>
        <meta name="keywords" content="<?php echo $meta_keywords; ?>" />
        <meta name="description" content="<?php echo $meta_description; ?>" />
        <meta name="copyright" content="<?php echo $meta_copywrite; ?>" />
        <?php foreach ($styles as $file => $type) echo HTML::style($file, array('media' => $type)), "\n"; ?>
        <?php foreach ($scripts as $file) echo HTML::script($file, NULL, TRUE), "\n"; ?>
    </head>
    <body>
        <div class="container">
            <?php echo $content; ?>
        </div>
    </body>
</html>
