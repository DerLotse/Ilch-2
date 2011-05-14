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
        'description' => 'Ilch2.0 Standard Design - Frontend',
        'styles' => array(
            'media/blueprint/screen.css' => 'screen',
            'media/blueprint/print.css' => 'print',
            'media/blueprint/plugins/fancy-type/screen.css' => 'screen',
        ),
        'scripts' => array(),
    ),
);