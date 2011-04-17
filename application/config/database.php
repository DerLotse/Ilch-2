<?php defined('SYSPATH') OR die('No direct access allowed.');

return array(
    'default' => array(
        'type' => 'mysql',
        'connection' => array(
            'hostname' => 'localhost',
            'username' => 'root',
            'password' => FALSE,
            'persistent' => FALSE,
            'database' => 'ilchcms2x',
        ),
        'table_prefix' => 'ic1_',
        'charset' => 'utf8',
        'caching' => FALSE,
        'profiling' => TRUE,
    )
);
