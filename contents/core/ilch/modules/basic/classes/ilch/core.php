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
