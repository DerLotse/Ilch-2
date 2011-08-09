<?php
defined('SYSPATH') or die('No direct script access.');

class Ilch_Group {

	public static $_cache_key = 'group_data_cache';

	protected static $_cache_lifetime = NULL;

	protected static $_group_data = NULL;

	public static function data($group_id)
	{
		// Create Array
		$group_id = (array) $group_id;
		
		// Check Cache
		if (is_array(Group::$_group_data) === FALSE and Ilch::$caching === TRUE)
		{
			Group::$_group_data = Cache::instance()->get(Group::$_cache_key, array());
		}
		
		// Create caching check
		$new_values = FALSE;
		
		// Create empty cache
		$cache = array();
		
		foreach ($group_id as $group)
		{
			// Get group config and permissions if no data available
			if (isset(Group::$_group_data[$group]) === FALSE)
			{
				$group_model = Model::factory('group');
				
				Group::$_group_data[$group]['config'] = $group_model->config($group);
				Group::$_group_data[$group]['permissions'] = $group_model->permissions($group);
				
				$new_values = TRUE;
			}
			
			// Set group config
			if (isset($cache['config']) === FALSE)
			{
				$cache['config'] = Group::$_group_data[$group]['config'];
			}
			
			// Merge group permissions
			$cache['permissions'] = array_merge(Group::$_group_data[$group]['permissions'], Arr::get($cache, 'permissions', array()));		
		}
		
		// Caching new values when cache active
		if ($new_values === TRUE AND Ilch::$caching === TRUE)
		{
			Cache::instance()->set(Group::$_cache_key, Group::$_group_data, Group::$_cache_lifetime);
		}
		
		// If no values ​​exist, set empty values
		if ($cache == FALSE)
		{
			$cache = array('config' => array(), 'permissions' => array());
		}
		
		// Return cached array
		return $cache;
	}

	public static function data_by_user($user_id = NULL)
	{
		// Check user id
		$user_id = Group::_check_user_id($user_id);
		
		// Get groups
		$groups = Model::factory('group')->user_groups($user_id);
		
		// Return group data
		return Group::data($groups);
	}

	public static function permission($group_id)
	{
		// Get from group data
		$group_data = Group::data($group_id);
		
		// Return Permissions
		return $group_data['permissions'];
	}

	public static function permission_by_user($user_id = NULL)
	{
		// Check user id
		$user_id = Group::_check_user_id($user_id);
		
		// Get groups
		$groups = Model::factory('group')->user_groups($user_id);
		
		// Return group data
		return Group::permission($groups);
	}

	public static function config($group_id)
	{
		// Get from group data
		$group_data = Group::data($group_id);
		
		// Return Permissions
		return $group_data['config'];
	}

	public static function config_by_user($user_id = NULL)
	{
		// Check user id
		$user_id = Group::_check_user_id($user_id);
		
		// Get groups
		$groups = Model::factory('group')->user_groups($user_id);
		
		// Return group data
		return Group::config($groups);
	}

	public static function cache_get($group_id = NULL)
	{
		if (is_array(Group::$_group_data) === FALSE and Ilch::$caching === TRUE)
		{
			Group::$_group_data = Cache::instance()->get(Group::$_cache_key, array());
		}
		
		if (is_null($group_id) === FALSE)
		{
			return Arr::get(Group::$_group_data, $group_id, array());
		}
		else
		{
			return Group::$_group_data;
		}
	}

	public static function cache_set($group_id, $group_data)
	{
		if (Ilch::$caching === TRUE)
		{
			$cache = Group::cache_get();
			$cache[$group_id] = $group_data;
			Cache::instance()->set(Group::$_cache_key, $cache, Group::$_cache_lifetime);
		}
		
		Group::$_group_data[$group_id] = $group_data;
	}

	private static function _check_user_id($user_id)
	{
		if (is_null($user_id) === FALSE)
		{
			return $user_id;
		}
		else if (is_null($user_id) === TRUE and User::auth()->logged_in() === TRUE)
		{
			return $_SESSION['user_data']['user_id'];
		}
		throw new Kohana_Exception('Missing user id for result');
	}

}