<p>
    Die Datenbank ist auf dem Stand der <b>Revision <?php echo $revision; ?></b>.
</p>
<ul>
    <li><a href="<?php echo URL::site('backend/svn'); ?>" style="color: green;">Datenbankupdate starten</a></li>
    <li><a href="<?php echo URL::site('backend/svn/reset'); ?>" style="color: orangered;">Datenbankreset starten</a></li>
</ul>
<ul>
    <li><a href="<?php echo URL::site('backend/config/create'); ?>" style="color: grey;">Config Statement Generator</a></li>
</ul>
<?php if (CACHE_ENABLED === TRUE): ?>
<ul>
	<li><a href="<?php echo URL::site('backend/cache'); ?>" style="color: darkgrey;">Cache leeren</a></li>
</ul>
<?php endif; ?>