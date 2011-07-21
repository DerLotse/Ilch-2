<?php

defined('SYSPATH') or die('No direct script access.');

return array(
    'cookie' => array(
        'encrypted' => TRUE,
    ),
    'native' => array(
        'encrypted' => TRUE,
    ),
    'database' => array(
        'table' => 'sessions',
        'columns' => array(
		'session_id'  => 'session_id',
		'last_active' => 'session_last_active',
		'contents'    => 'session_contents'
	)
    ),
);