<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Frontend <?php echo $title; ?></title>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <meta name="keywords" content="<?php echo $meta_keywords; ?>" />
        <meta name="description" content="<?php echo $meta_description; ?>" />
        <meta name="copyright" content="<?php echo $meta_copywrite; ?>" />
        <?php foreach ($styles as $file => $type){echo HTML::style($file, array('media' => $type)), "\n";} ?>
        <?php foreach ($scripts as $file){echo HTML::script($file, NULL, TRUE), "\n";} ?>
    </head>
  <!--[if lt IE 7 ]><body class="no-js ie6"><![endif]-->
  <!--[if IE 7 ]><body class="no-js ie7"><![endif]-->
  <!--[if IE 8 ]><body class="no-js ie8"><![endif]-->
  <!--[if (gte IE 9)|!(IE)]><!--> <body class=no-js> <!--<![endif]-->
        <?php echo $content; ?>
    </body>
</html>