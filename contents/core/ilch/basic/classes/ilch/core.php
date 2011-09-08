<?php
defined('SYSPATH') or die('No direct script access.');

class Ilch_Core {

	const VERSION = '2.0.0 SVN-Version';

	const CODENAME = 'Pluto';

	public static $caching = FALSE;
	
	public static $modules = array();
	
	public static $module_version = array();
	
	protected static $_module_cache = array();
	
	protected static $_module_position = array();

	/**
	 * Load all needed modules and themes and set needed config
	 * @param array with options
	 */
	public static function init($options = array())
	{
		// Set caching
		if (isset($options['caching']) === TRUE)
		{
			Ilch::$caching = $options['caching'];
		}
		
		// Get modules
		Ilch::load_modules();
		
		/*
		// Attach a database reader to config.
		Kohana::$config->attach(new Config_Database());
		
		// Set session adapter
		Session::$default = 'database';
		
		// Set Cookie Salt
		Cookie::$salt = Kohana::$config->load('cookie')->salt;
		
		// Attach a session reader to config.
		Kohana::$config->attach(new Config_Session());
		
		// Load active modules from database
		Model::factory('module')->load();
		*/
	}
	
	/**
	 * Load all active Modules from the Database
	 */
	public static function load_modules()
	{
		// Load database module
		Kohana::modules(array('kohana_database' => MODPATH.'core'.DIRSEPA.'kohana'.DIRSEPA.'database'));
		
		// Get all active modules
		Ilch::$_module_cache = DB::select('module_name', 'module_version')->from('modules')->execute()->as_array('module_name', 'module_version');
			
		// If cache valid
		if (Ilch::$_module_cache)
		{
			foreach(Ilch::$_module_cache AS $module => $version)
			{
				Ilch::load_module($module, $version);
			}
		}
		
		// Load modules into kohana
		Ilch::update_modules();
	}
	
	/**
	 * Load given module
	 */
	public static function load_module($module, $version)
	{	
		// Abort if module already loaded
		if (isset(Ilch::$modules[$module])) return TRUE;
		
        // Load module path
		$module_path = Ilch::module_path($module);
		
		// Check module directory
		if (!is_dir($module_path)) return FALSE;
		
		// Load configuration
		$config = Arr::get((file_exists($module_path.'config'.DIRSEPA.'module'.EXT)) ? Kohana::load($module_path.'config'.DIRSEPA.'module'.EXT) : array(), $module, array());
		
		// Check module version
		if (!empty($version) AND Ilch::version_compare($version, '<', Arr::get(Arr::get($config, 'details', array()), 'version', 0)))
		{
			// @todo Automatisches installieren neuer Datenbankeinträge
		}
		else if(!empty($version) AND Ilch::version_compare($version, '>', Arr::get(Arr::get($config, 'details', array()), 'version', 0)))
		{
			return FALSE;
		}
		
		// Save version number
		Ilch::$module_version[$module] = (!empty($version)) ? Arr::get(Arr::get($config, 'details', array()), 'version', 0) : 0;
		
        // Module position
        $position = NULL;
		
	    // Place using required data
        if (isset($config['required']))
        {
            foreach ($config['required'] AS $required_module => $required_version)
            {
				// If module is not loaded
				if (!isset(Ilch::$modules[$required_module]) AND !Ilch::load_module($required_module, $required_version))
				{
					return FALSE;
				}
				else if (isset(Ilch::$modules[$required_module]) AND true)
				{
					// @todo Hier weiterarbeiten ;)
				}
            }
        }
		
        // Place using extends data
        if (isset($config['extends']))
        {
            foreach ($config['extends'] AS $extend)
            {
                if (isset(Ilch::$_module_position[$extend]) AND ($position === NULL OR Ilch::$_module_position[$extend] < $position))
                {
                    $position = Ilch::$_module_position[$extend];
                }
            }
        }
		
		// Place module finaly
        if ($position === NULL)
        {
            Ilch::$modules[$module] = $module_path;
        }
        else
        {
            Ilch::$modules[$modules] = Ilch::module_place($module, $module_path, $position);
        }
				
		// Set new module positions
		Ilch::$_module_position = array_flip(array_keys(Ilch::$modules));
		
		return TRUE;
	}
	
	/**
	 * Send loaded modules to Kohana
	 */
	public static function update_modules()
	{
		Kohana::modules(Ilch::$modules);
	}
	
	/**
	 * Get module path by name
	 * @param string $module_name
	 * @return string module path
	 */
	public static function module_path($module_name)
	{
		// Split module name
		$module_arr = explode('_', $module_name);
		
		// Check data
		if (count($module_arr) == 1)
		{
			return ((is_dir(APPPATH.'modules'.DIRSEPA.$module_arr[0])) ? APPPATH : MODPATH).'modules'.DIRSEPA.$module_arr[0].DIRSEPA;
		}
		else
		{
			return MODPATH.'core'.DIRSEPA.$module_arr[0].DIRSEPA.$module_arr[1];
		}
	}
	
	/**
	 * Get theme path by name
	 * @param string $theme_name
	 * @return string Theme path
	 */
	public static function theme_path($theme_name)
	{
		return ((is_dir(APPPATH.'themes'.DIRSEPA.$theme_name)) ? APPPATH : MODPATH).'themes'.DIRSEPA.$theme_name;
	}


	/**
	 * Compare two Versions with the Ilch 2 standard version syntax
	 *
	 *     Ilch::compare_version('1.3.4 Beta 1', '<', '1.3.4 Alpha 3'); // Return false
	 *
	 *     Ilch::compare_version('1.3.4 Beta 1', '<', '1.3.4'); // Return true
	 *
	 * 
	 */
	public static function version_compare($act_version, $compare_operator, $new_version)
	{
		// Create full version number
		$act_version = Ilch::version_number($act_version);
		$act_version = Ilch::version_number($new_version);
	
		// Check version number
		switch($compare_operator) {
			case '>': return ($act_version > $new_version); break;
			case '<': return ($act_version < $new_version); break;
			case '>=': return ($act_version >= $new_version); break;
			case '<=': return ($act_version <= $new_version); break;
			case '==': return ($act_version == $new_version); break;
		}
		
		return FALSE;
	}
	
	/**
	 * Get the integer value of a string with the Ilch 2 standard version syntax
	 */
	public static function version_number($version)
	{
		// Named versions
		$named_versions = array(
			'development' => 0,
			'dev' => 0,
			'prealpha' => 1,
			'alpha' => 2,
			'beta' => 3,
			'releasecandidate' => 4,
			'rc' => 4
		);
		
		// Split versions
		$version = explode(' ', trim($version));
		$version[0] = explode('.', $version[0]);
				
		$version = array(
			0 => Arr::get($version[0], 0, 0),
			1 => Arr::get($version[0], 1, 0),
			2 => Arr::get($version[0], 2, 0),
			3 => (isset($version[1])) ? Arr::get($named_versions, strtolower($version[1]), 0) : 0,
			4 => Arr::get($version, 2, 0)
		);
		
		// Format and return
		return sprintf('%d.%03d%03d%03d%03d', $version[0], $version[1], $version[2], $version[3], $version[4]);
	}
	

	/**
	 * Dynamic Ilch CMS route
	 * @param string given url
	 * @return array
	 */
	public static function route($uri)
	{
		// Defaults
		$return_arr = array();
		
		// If Backend
		if (preg_match('#^backend(?:/(?P<controller>[^/.,;?\n]++)(?:/(?P<action>[^/.,;?\n]++)(?:/(?P<overflow>(.*?)))?)?)?$#uD', $uri, $match))
		{
			// Directory
			$return_arr['directory'] = 'backend';
			
			// Controller
			$return_arr['controller'] = (isset($match[1]) === TRUE) ? $match[1] : Kohana::$config->load('ilch')->start_controller;
			
			// Action
			$return_arr['action'] = (isset($match[2]) === TRUE) ? $match[2] : 'index';
			
			// Overflow
			$return_arr += (isset($match[3]) === TRUE) ? explode('/', $match[3]) : array();
		}
		// If Frontend
		else if (preg_match('#^(?:(?P<controller>[^/.,;?\n]++)(?:/(?P<action>[^/.,;?\n]++)(?:/(?P<overflow>(.*?)))?)?)?$#uD', $uri, $match))
		{
			// Directory
			$return_arr['directory'] = 'frontend';
			
			// Controller
			$return_arr['controller'] = (isset($match[1]) === TRUE) ? $match[1] : Kohana::$config->load('ilch')->start_controller;
			
			// Action
			$return_arr['action'] = (isset($match[2]) === TRUE) ? $match[2] : 'index';
			
			// Overflow
			$return_arr += (isset($match[3]) === TRUE) ? explode('/', $match[3]) : array();
		}

		// Return Route-Array
		if ($return_arr == TRUE) return $return_arr;
	}
}
