<?php
defined('SYSPATH') or die('No direct script access.');

class Ilch_Permission {

	protected static $_instance = FALSE;

	protected static $_permissions = array();

	protected static $_cache_key = 'permission_cache';

	protected static $_cache_lifetime = NULL;

	/**
	 * 
	 * Enter description here ...
	 */
	protected static function init()
	{
		if (Permission::$_instance !== TRUE)
		{
			if (CACHE_ENABLED === TRUE)
			{
				$cache = Cache::instance()->get(Permission::$_cache_key);
			}
			
			if (CACHE_ENABLED === FALSE or !$cache)
			{
				$query = DB::select('permission_group', 'permission_key', 'permission_value')->from('permissions')
					->execute();
				
				// Create empty cache
				$cache = array();
				
				if (count($query) > 0)
				{
					foreach ($query as $entry)
					{
						if (!isset($cache[$entry['permission_group']]))
						{
							$cache[$entry['permission_group']] = array();
						}
						
						$cache[$entry['permission_group']][$entry['permission_key']] = (int) $entry['permission_value'];
					}
					
					if (CACHE_ENABLED === TRUE)
					{
						// Save the configuration in cache
						Cache::instance()->set(self::$_cache_key, $cache, Permission::$_cache_lifetime);
					}
				}
			}
			
			// Merge Session Permissions and Default Permissions
			Permission::$_permissions = array_merge($cache, Session::instance()->get('user_permissions', array()));
			
			// Set instance
			Permission::$_instance = TRUE;
		}
	}

	/**
	 * 
	 * Check User Permission with Session data and default permissions
	 * 
	 * only one permission
	 *
	 *     Permission::has('group', 'key', 'default' = FALSE);
	 *
	 * more permissions
	 *
	 *     Permission::has(array(
	 * 						'group1' => array('key1' => 'default', 'key2' => 'default'),
	 * 						'group2' => array('key1' => 'default')
	 * 						));
	 *
	 * or without default parameter
	 *
	 *     Permission::has(array(
	 *    					'group1' => array('key1', 'key2'),
	 *    					'group2' => array('key1')
	 *    					));
	 *
	 * @param mixed $group string with group name or array with group, key and default values
	 * @param string $key
	 * @param boolean $default
	 * @throws Kohana_Exception
	 * @return boolean
	 */
	public static function has($group, $key = NULL, $default = FALSE)
	{
		// Get instance
		Permission::init();

		if (is_array($group))
		{
			foreach ($group as $group => $values)
			{
				foreach($values as $value_key => $value_default)
				{
					if (is_numeric($value_key) === TRUE)
					{
						if(Permission::has($group, $value_default, $default) === FALSE) return FALSE;
					}
					else
					{
						if(Permission::has($group, $value_key, $value_default) === FALSE) return FALSE;
					}
				}
			}
			
			return TRUE;
		}
		
		if ($key === NULL)
		{
			throw new Kohana_Exception('Missing $key for $group ":group"', array(':group' => $group));
		}
		
		if (isset(Permission::$_permissions[$group][$key]) === FALSE)
		{
			return $default;
		}

		return (bool) Permission::$_permissions[$group][$key];
	}
}