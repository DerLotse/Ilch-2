<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Ilch CMS 2.X - Backend - <?php echo $title; ?></title>
        <meta name="keywords" content="<?php echo $meta_keywords; ?>" />
        <meta name="description" content="<?php echo $meta_description; ?>" />
        <meta name="copyright" content="<?php echo $meta_copywrite; ?>" />
        <?php foreach ($styles as $file => $type) echo HTML::style($file, array('media' => $type), NULL, TRUE), "\n"; ?>
        <?php foreach ($scripts as $file) echo HTML::script($file, NULL, NULL, TRUE), "\n"; ?>
    </head>
    <body>
        <div class="container">
        	<div class="span-24 last">
                <?php echo $content; ?>
            </div>
            <hr />
            <div class="span-24 last">
            	<p class="right">
            		Ilch <?php echo Ilch::CODENAME.' '.Ilch::VERSION; ?>
            	</p>
            </div>
            <hr />
            <div class="span-24 last">
                <h3>Active Modules</h3>
                <table>
                    <thead>
                        <tr>
                            <th>KEY</th>
                            <th>VALUE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach(Kohana::modules() AS $key => $val) : ?>
                        <tr>
                            <td><?php echo $key; ?></td>
                            <td><?php echo $val; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="span-24 last">
                <h3>Profiling</h3>
                <?php
                if (Kohana::$profiling === TRUE)
                {
                    echo View::factory('profiler/stats');
                }
                ?>
            </div>
        </div>
    </body>
</html>
