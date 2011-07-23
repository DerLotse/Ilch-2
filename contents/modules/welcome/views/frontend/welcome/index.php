<?php defined('SYSPATH') or die('No direct script access.'); ?>

<h1><?php echo $title; ?></h1>
<p>
    Frontend Controller
</p>
<p>
    Der Controller liegt in: <i>contents/modules/welcome/classes/controller/<b>frontend</b>/welcome.php</i>
</p>
<p>
    <a href="<?php echo URL::site('backend'); ?>">Zum Backend wechseln</a>
</p>

<?php

echo (Permission::has(array('flomavali.ilch' => array('admin')))) ? 'DU HAST DAS RECHT' : 'NEIN, DU HAST DIESES RECHT NICHT';