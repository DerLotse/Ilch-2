<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Ilch CMS 2.X - <?php echo $title; ?></title>
        <meta name="keywords" content="<?php echo $meta_keywords; ?>" />
        <meta name="description" content="<?php echo $meta_description; ?>" />
        <meta name="copyright" content="<?php echo $meta_copywrite; ?>" />
        <?php foreach ($styles as $file => $type) echo HTML::style($file, array('media' => $type), NULL, TRUE), "\n"; ?>
        <?php foreach ($scripts as $file) echo HTML::script($file, NULL, NULL, TRUE), "\n"; ?>
    </head>
    <body>
    	<div id="header">
    		<?php echo HTML::anchor(NULL, HTML::image('frontend/media/images/frontend/logo.png', NULL, NULL, TRUE)); ?>
    	</div>
    	<div id="wrapper">
    		<div id="left_sidebar">
    			<div class="menu_head">
    				Menü
    			</div>
    			<ul class="menu_body">
    				<li><a href="#">Link</a></li>
    				<li><a href="#">Link</a></li>
    				<li><a href="#">Link</a></li>
    				<li><a href="#">Link</a></li>
    				<li><a href="#">Link</a></li>
    			</ul>
    			<div class="menu_head">
    				Clan Menü
    			</div>
    			<ul class="menu_body">
    				<li><a href="#">Link</a></li>
    				<li><a href="#">Link</a></li>
    				<li><a href="#">Link</a></li>
    				<li><a href="#">Link</a></li>
    				<li><a href="#">Link</a></li>
    			</ul>
    		</div>
    		<div id="content_frame">
    			<div id="content">
    				<?php echo $content; ?>
    			</div>
    		</div>
    		<div id="right_sidebar">
    			<div class="menu_head">
    				Login
    			</div>
    			<div class="menu_body">
    				<?php echo Widget_Svn::get(); ?>
    			</div>
    			<div class="menu_head">
    				Statistik
    			</div>
    			<div class="menu_body">
    				<ul>
    					<li>Besucher Heute: 6432</li>
    					<li>Besucher Gestern: 2652</li>
    					<li>Besucher Online: 2</li>
    					<li>Besucher Gesamt: 7656432</li>
    				</ul>
    			</div>
    			<div class="menu_head">
    				Login
    			</div>
    			<div class="menu_body">
    				<?php echo Widget_User_Login::get(); ?>
    			</div>
    		</div>
    		<br class="x" />
    		<div id="footer">
    			<span>
    				Design by <a href="http://www.oldesworld.de/">oldesworld.de</a> | Script Copyright by <a href="http://www.ilch.net/">ilch.net</a>
    			</span>
    			<?php echo HTML::image('frontend/media/images/frontend/logo_footer.png', NULL, NULL, TRUE); ?>
    			<br class="x" />
    		</div>
    	</div>
    	
    	<div style="width: 960px; margin: 0 auto;">
			<table class="table">
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
			<br /><br />
			<?php
				if (Kohana::$profiling === TRUE)
				{
					echo View::factory('profiler/stats');
				}
			?>
		</div>
    </body>
</html>