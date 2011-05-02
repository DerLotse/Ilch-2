<?php

defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------
// Load the core Kohana class
require SYSPATH . 'classes/kohana/core' . EXT;

if (is_file(APPPATH . 'classes/kohana' . EXT))
{
    // Application extends the core
    require APPPATH . 'classes/kohana' . EXT;
}
else
{
    // Load empty core extension
    require SYSPATH . 'classes/kohana' . EXT;
}

/**
 * Set the default time zone.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('Europe/Berlin');

/**
 * Set the default locale.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'de_DE.utf-8');

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

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('de');

/**
 * Set database session as default
 */
Session::$default = 'database';

/**
 * Set Cookie salt // Spaeter automatisch erzeugen lassen
 */
COOKIE::$salt = 'testsalt';

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV']))
{
    Kohana::$environment = constant('Kohana::' . strtoupper($_SERVER['KOHANA_ENV']));
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
    'base_url' => 'http://' . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']),
    'index_file' => ''
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH . 'logs'));

/**
 * Attach a file reader to config.
 */
Kohana::$config->attach(new Config_File, FALSE);

/**
 * Load Kohana Database Module
 */
Kohana::modules(array(
    'database' => MODPATH . 'database',
));

/* * *****************************************************************************
 * ************************* PRÜFUNG AUF ERSTEN AUFRUF **************************
 * ***************************************************************************** */
$db = Database::instance();
$prefix = $db->table_prefix();
$tables = $db->list_tables($prefix . 'settings');

// Wenn erster Aufruf
if (count($tables) == 0)
{
    // Definieren
    define('FIRST_RUN', true);

    // Nötige Module laden
    Kohana::modules(array(
        'svn' => IC_CORE . 'svn' // SVN-verwaltung
    )+Kohana::modules());

    // Route setzen, die sofort Installation anstrebt
    Route::set('default', '(backend(/svn(/index(/first_run))))')
            ->defaults(array(
                'directory' => 'backend/',
                'controller' => 'svn',
                'action' => 'reset',
                'first_run' => TRUE
            ));
}
// Wenn NICHT erster Aufruf
else
{
    // Definieren
    define('FIRST_RUN', false);

    /**
     * Enable Ilch modules.
     */
    Kohana::modules(array(
        // Ilch Database Settings Module
        IC_CORE . 'setting' => IC_CORE . 'setting', // Database settings
        
        // Other Ilch Modules
        IC_CORE . 'module' => IC_CORE . 'module',
        IC_CORE . 'template' => IC_CORE . 'template',
        IC_CORE . 'svn' => IC_CORE . 'svn',
    )+Kohana::modules());
    
    /**
     * Enable Kohana modules.
     */
    Kohana::modules(Kohana::modules()+array(
	   'auth'       => MODPATH.'auth',       // Basic authentication
	// 'cache'      => MODPATH.'cache',      // Caching with multiple backends
	// 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
	// 'image'      => MODPATH.'image',      // Image manipulation
	// 'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	// 'unittest'   => MODPATH.'unittest',   // Unit testing
	   'userguide'  => MODPATH.'userguide',  // User guide and API documentation
    ));

    /**
     * Attach a database reader to config.
     */
    Kohana::$config->attach(new Config_Database);
    
    /**
     * Set the routes. Each route must have a minimum of a name, a URI and a set of
     * defaults for the URI.
     */
    Route::set('default', array('Module', 'route'));
}
