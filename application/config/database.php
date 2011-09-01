<?php defined('SYSPATH') or die('No direct access allowed.');

return array('default' =>array (
  'type' => 'mysql',
  'connection' => 
  array (
    'hostname' => 'localhost',
    'database' => 'ilchcms2x',
    'username' => 'root',
    'password' => false,
    'persistent' => false,
  ),
  'table_prefix' => '$prefix_',
  'charset' => 'utf8',
  'caching' => false,
  'profiling' => false,
));