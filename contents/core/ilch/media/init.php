<?php defined('SYSPATH') or die('No direct script access.');

// Static file serving (CSS, JS, images)
Route::set('media', '(<directory>/)media(/<file>)', array('file' => '.+'))
	->defaults(array(
		'controller' => 'media',
		'action'     => 'index',
		'file'       => NULL,
	));