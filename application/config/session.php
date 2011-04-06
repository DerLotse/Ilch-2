<?php defined('SYSPATH') OR die('No direct access allowed.');

return array(
    'native' => array(
        'name' => 'ilchcms2x',
        'lifetime' => 43200,
    ),
    'cookie' => array(
        'name' => 'ilchcms2x',
        'encrypted' => TRUE,
        'lifetime' => 43200,
    ),
    'database' => array(
        'name' => 'ilchcms2x',
        'encrypted' => TRUE,
        'lifetime' => 43200,
        'group' => 'default',
        'table' => 'sessions',
        'columns' => array(
            'session_id'  => 'session_id',
            'last_active' => 'last_active',
            'contents'    => 'contents'
        ),
        'gc' => 500,
    ),
);