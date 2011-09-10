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
            Kohana::$index_file.'/media/blueprint/screen.css' => 'screen',
            Kohana::$index_file.'/media/blueprint/print.css' => 'print',
        ),
        'scripts' => array(),
    ),
);