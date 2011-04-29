<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Ilch CMS 2.X - <?php echo $title; ?></title>
        <meta name="keywords" content="<?php echo $meta_keywords; ?>" />
        <meta name="description" content="<?php echo $meta_description; ?>" />
        <meta name="copyright" content="<?php echo $meta_copywrite; ?>" />
        <?php foreach ($styles as $file => $type) echo HTML::style($file, array('media' => $type)), "\n"; ?>
        <?php foreach ($scripts as $file) echo HTML::script($file, NULL, TRUE), "\n"; ?>
    </head>
    <body>
        <div class="container">
            <h1>Ilch CMS 2.x - Das CMS für jedermann!</h1>
            <hr />
            <h2 class="alt"><?php echo $title; ?></h2>
            <hr />
            <hr class="space" />
            <div class="span-16 append-1 last">
                <?php echo $content; ?>
            </div>
            <div class="span-7 last">
                <h3>SVN Datenbank</h3>
                <?php echo Widget_Svn::get(); ?>
                <hr />
                <h3>Login (Ohne Funktion)</h3>
                <?php echo Widget_Login::get(); ?>
            </div>
            <div class="span-24 last">
                <p>
                   &copy 2011 by Ilch.de Developer
                </p>
            </div>
        </div>
    </body>
</html>
