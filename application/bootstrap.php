<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Load the core Kohana class
 */
require SYSPATH.'classes/kohana/core'.EXT;

if (is_file(APPPATH.'classes/kohana'.EXT))
{
    // Application extends the Kohana core
    require APPPATH.'classes/kohana'.EXT;
}
else
{
    // Ilch Basic Module extends the Kohana core
    require MODPATH.'core/ilch/basic/classes/kohana'.EXT;
}

/**
 * Load the core Ilch class
 */
require MODPATH.'core/ilch/basic/classes/ilch/core'.EXT;

if (is_file(APPPATH.'classes/ilch'.EXT))
{
    // Application extends the Ilch core
    require APPPATH.'classes/ilch'.EXT;
}
else
{
    // Ilch Basic Module extends the Ilch core
    require MODPATH.'core/ilch/basic/classes/ilch'.EXT;
}

/**
 * Set the default time zone.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('America/Chicago');

/**
 * Set the default locale.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://kohanaframework.org/guide/using.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

/**
 * Set the default language
 */
I18n::lang('en-us');

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV']))
{
    Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
Kohana::init(array(
    'base_url' => preg_replace('/[^\/]+$/','',$_SERVER['SCRIPT_NAME']),
    'index_file' => 'index.php',
    'profile' => TRUE, // enable profiling for dev.
    'caching' => FALSE,
    'cache_life' => 3600 // @todo noch zu testen, ob eine Stunde sinnvoll oder doch nur eine Minute
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Now initialize the Ilch core
 */
Ilch::init();

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
Route::set('default', array('Ilch', 'route'));