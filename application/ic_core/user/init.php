<?php defined('SYSPATH') or die('No direct script access.');

// Static file serving (CSS, JS, images)
Route::set('user', 'user(/<controller>(/<action>(/<overflow>)))', array('overflow' => '.*'))
      ->defaults(array(
          'directory' => 'frontend/user',
          'controller' => 'login',
          'action' => 'index',
  ));