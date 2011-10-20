<?php

defined('SYSPATH') or die('No direct access allowed.');

return array
    (
    /**
     * 	publish additional informations needed for the active theme
     */
    'theme' => array
        (
        'name' => 'Standard Ilch Nr. 1',
        'description' => 'Ilch2.0 Standard Design - Backend',
        'styles' => array(
            'frontend/media/blueprint/screen.css' => 'screen',
            'frontend/media/blueprint/print.css' => 'print',
        ),
        'scripts' => array(),
    ),
);