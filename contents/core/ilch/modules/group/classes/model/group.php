<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Group extends Model {

	function user_groups($user_id)
	{
		return DB::select('group_id')->from('group_users')
			->where('user_id', '=', $user_id)
			->order_by('user_main_group', 'DESC')
			->execute()
			->as_array(NULL, 'group_id');
	}

	function config($group_id)
	{
		// DB Query
		$result = DB::select('group_config.group_config_value', 'config.config_group', 'config.config_key')->from('group_config')
			->join('config', 'LEFT')
			->on('group_config.config_id', '=', 'config.config_id')
			->where('group_config.group_id', '=', $group_id)
			->execute();
		
		// Empty function cache
		$cache = array();
		
		if (count($result) > 0)
		{
			foreach ($result as $row)
			{
				// Fill function cache
				$cache[$row['config_group']][$row['config_key']] = unserialize($row['group_config_value']);
			}
		}
		
		// Return cached array
		return $cache;
	}
	
	function permissions($group_id)
	{
		// DB Query
		$result = DB::select('permissions.permission_group', 'permissions.permission_key')->from('group_permissions')
			->join('permissions', 'LEFT')
			->on('group_permissions.permission_id', '=', 'permissions.permission_id')
			->where('group_permissions.group_id', '=', $group_id)
			->execute();
		
		// Empty function cache
		$cache = array();
		
		if (count($result) > 0)
		{
			foreach ($result as $row)
			{
				// Fill function cache
				$cache[$row['permission_group']][$row['permission_key']] = 1;
			}
		}
		
		// Return cached array
		return $cache;
	}
}