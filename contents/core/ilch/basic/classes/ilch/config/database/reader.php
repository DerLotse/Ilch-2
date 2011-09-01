<?php
defined('SYSPATH') or die('No direct script access.');

/**
 * Database reader for the kohana config system
 *
 * @package    Kohana/Database
 * @category   Configuration
 * @author     Kohana Team
 * @copyright  (c) 2011 Kohana Team
 * @license    http://kohanaframework.org/license
 */
class Ilch_Config_Database_Reader implements Kohana_Config_Reader {

	protected $_db_instance = 'default';

	protected $_table_name = 'config';

	public static $_cache_key = 'database_config';

	protected $_cache_lifetime = NULL;

	/**
	 * Constructs the database reader object
	 *
	 * @param array Configuration for the reader
	 */
	public function __construct(array $config = NULL)
	{
		if (isset($config['instance']))
		{
			$this->_db_instance = $config['instance'];
		}
		
		if (isset($config['table_name']))
		{
			$this->_table_name = $config['table_name'];
		}
	}

	/**
	 * Tries to load the specificed configuration group
	 *
	 * Returns FALSE if group does not exist or an array if it does
	 *
	 * @param  string $group Configuration group
	 * @return boolean|array
	 */
	public function load($group)
	{
		if ($group === 'database' or $group === 'cache')
		{
			return FALSE;
		}
		
		if (Ilch::$caching === TRUE)
		{
			// Try get the config from cache
			$config = Cache::instance()->get(self::$_cache_key);
		}
		
		if (Ilch::$caching === FALSE or !$config)
		{
			// Load all of the configuration values
			$query = DB::select('config_key', 'config_value', 'config_group')->from($this->_table_name);
			
			if (Ilch::$caching === FALSE)
			{
				$query = $query->where('config_group', '=', $group);
			}
			
			$query = $query->execute($this->_db_instance);
			
			$config = array();
			
			if (count($query) > 0)
			{
				if (Ilch::$caching === TRUE)
				{
					// Build the cache configuration array that contains ALL the config entries
					foreach ($query as $entry)
					{
						if (!isset($config[$entry['config_group']]))
						{
							$config[$entry['config_group']] = array();
						}
						
						$config[$entry['config_group']][$entry['config_key']] = unserialize($entry['config_value']);
					}
					
					// Save the configuration in cache
					Cache::instance()->set(self::$_cache_key, $config, $this->_cache_lifetime);
				}
				else
				{
					// Unserialize the configuration values
					$config[$group] = array_map('unserialize', $query->as_array('config_key', 'config_value'));
				}
			}
		}
		
		// Use the group config if it exists
		return Arr::get($config, $group, FALSE);
	}
}
