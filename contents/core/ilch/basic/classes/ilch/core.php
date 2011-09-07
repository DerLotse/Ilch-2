<?php
defined('SYSPATH') or die('No direct script access.');

class Ilch_Core {

	const VERSION = '2.0.0 SVN-Version';

	const CODENAME = 'Pluto';

	public static $caching = FALSE;

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
		
		echo Ilch::module_path('ilch_svn');
		
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
	 * 
	 * Enter description here ...
	 */
	public static function load_modules()
	{
		// Load cache data
		$cache = (Ilch::$caching) ? Kohana::cache('Ilch::load_modules()') : NULL;
		
		// If cache invalid
		if (!$cache)
		{
			// Load database module
			Kohana::modules(array('kohana_database' => MODPATH.'core'.DIRSEPA.'kohana'.DIRSEPA.'database'));
			
			// Get all active modules
			$query = DB::select('module_name', 'module_version')->from('modules')->execute();
			
			foreach ($query AS $row)
			{
				print_r($row);
			}
		}
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
			return ((is_dir(APPPATH.'modules'.DIRSEPA.$module_arr[0])) ? APPPATH : MODPATH).'modules'.DIRSEPA.$module_arr[0];
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
