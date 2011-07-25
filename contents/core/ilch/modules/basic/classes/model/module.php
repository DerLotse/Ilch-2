<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Module extends Model {

	public static $_modul_cache_key = 'module_cache';

	protected $_cache_lifetime = NULL;

	public function load()
	{
		if (Ilch::$caching === TRUE)
		{
			// Try get the modules from cache
			$module_array = Cache::instance()->get(self::$_modul_cache_key);
		}
		
		if (Ilch::$caching === FALSE OR !$module_array)
		{
			// Get active modules
			$result = DB::select('module_directory', 'module_name')->from('modules')
				->where('module_active', '=', 1)
				->execute()
				->as_array();
			
			// Create empty modul array
			$module_array = array('core' => array(), 'custom' => array());
			
			// Fill module array
			foreach ($result as $row)
			{
				// If directory not empty
				if (empty($row['module_directory']) === FALSE)
				{
					// Split directory value
					$directory = explode('_', $row['module_directory']);
					
					// Set module type
					$module_type = ($directory[0] == 'core') ? 'core' : 'custom';
					
					// Get module path
					$module_path = implode(DIRSEPA, $directory) . DIRSEPA . 'modules' . DIRSEPA . $row['module_name'];
				}
				else
				{
					// Set module type
					$module_type = 'custom';
					
					// Get module path
					$module_path = 'modules' . DIRSEPA . $row['module_name'];
				}
				
				// Save modul details
				$module_array[$module_type][str_replace(DIRSEPA, '_', $module_path)] = MODPATH . $module_path;
			}
			
			if (Ilch::$caching === TRUE)
			{
				// Save in Cache
				Cache::instance()->set(self::$_modul_cache_key, $module_array, $this->_cache_lifetime);
			}
		}
		
		// New modules instance
		Kohana::modules($module_array['custom'] + Kohana::modules() + $module_array['core']);
	}
}