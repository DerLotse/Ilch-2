<?php
defined('SYSPATH') or die('No direct script access.');

class Ilch_Permission {

	protected $_instance = FALSE;

	protected $_permissions = array();

	protected $_cache_key = 'permission_cache';

	protected $_cache_lifetime = NULL;

	/**
	 * Ruft alle Standard-Berechtigungen ab und mischt die Session dazu
	 */
	protected function __construct()
	{
		if ($this->_instance !== TRUE)
		{
			if (Ilch::$caching === TRUE)
			{
				$cache = Cache::instance()->get($this->_cache_key);
			}
			
			if (Ilch::$caching === FALSE or !$cache)
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
						Cache::instance()->set($this->_cache_key, $cache, $this->_cache_lifetime);
					}
				}
			}
			
			// Merge Session Permissions and Default Permissions
			$this->_permissions = array_merge($cache, Session::instance()->get('user_permissions', array()));
		}
	}

	/**
	 * 
	 * Check User Permission with Session data and default permissions
	 * 
	 * only one permission
	 *
	 *     User::Permision->has('group', 'key', 'default' = FALSE);
	 *
	 * more permissions
	 *
	 *     User::Permision->has(array(
	 * 						'group1' => array('key1' => 'default', 'key2' => 'default'),
	 * 						'group2' => array('key1' => 'default')
	 * 						));
	 *
	 * or without default parameter
	 *
	 *     User::Permision->has(array(
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
	public function has($group, $key = NULL, $default = FALSE)
	{
		if (is_array($group))
		{
			foreach ($group as $group => $values)
			{
				foreach($values as $value_key => $value_default)
				{
					if (is_numeric($value_key) === TRUE)
					{
						if($this->has($group, $value_default, $default) === FALSE) return FALSE;
					}
					else
					{
						if($this->has($group, $value_key, $value_default) === FALSE) return FALSE;
					}
				}
			}
			
			return TRUE;
		}
		
		if ($key === NULL)
		{
			throw new Kohana_Exception('Missing $key for $group ":group"', array(':group' => $group));
		}
		
		if (isset($this->_permissions[$group][$key]) === FALSE)
		{
			return $default;
		}

		return (bool) $this->_permissions[$group][$key];
	}
}