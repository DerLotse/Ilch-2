<?php
defined('SYSPATH') or die('No direct script access.');

/**
 * Database-based configuration loader.
 *
 * Schema for configuration table:
 *
 * group_name    varchar(128)
 * config_key    varchar(128)
 * config_value  text
 * primary key   (group_name, config_key)
 *
 * @package    Kohana/Database
 * @category   Configuration
 * @author     Kohana Team
 * @copyright  (c) 2009 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Kohana_Config_Database extends Config_Reader {

	protected $_database_instance = 'default';

	protected $_database_table = 'config';

	public static $_cache_key = 'database_config';

	protected $_cache_lifetime = NULL;

	public function __construct(array $config = NULL)
	{
		if (isset($config['instance']))
		{
			$this->_database_instance = $config['instance'];
		}
		
		if (isset($config['table']))
		{
			$this->_database_table = $config['table'];
		}
		
		parent::__construct();
	}

	/**
	 * Query the configuration table for all values for this group,
	 * and store the data in cache.
	 *
	 * @param   string  group name
	 * @param   array   configuration array
	 * @return  $this   clone of the current object
	 */
	public function load($group, array $config = NULL)
	{
		if ($config !== NULL or $group === 'database' or $group === 'cache')
		{
			return parent::load($group, $config);
		}
		
		// Try get the config from cache
		$cache = Cache::instance()->get(self::$_cache_key);
		
		if (!$cache)
		{
			// Load all of the configuration values
			$query = DB::select('config_key', 'config_value', 'config_group')->from($this->_database_table)
				->execute();
			
			if (count($query) > 0)
			{
				$cache = array();
				
				// Build the cache configuration array that contains ALL the config entries
				foreach ($query as $entry)
				{
					if (!isset($cache[$entry['config_group']]))
					{
						$cache[$entry['config_group']] = array();
					}
					
					$cache[$entry['config_group']][$entry['config_key']] = unserialize($entry['config_value']);
				}
				
				// Save the configuration in cache
				Cache::instance()->set(self::$_cache_key, $cache, $this->_cache_lifetime);
			}
		}
		
		// Use the group config if it exists
		if (isset($cache[$group]) === TRUE)
		{
			$config = $cache[$group];
		}
		
		return parent::load($group, $config);
	}

	/**
	 * Overload setting offsets to insert or update the database values as
	 * changes occur.
	 *
	 * @param   string   array key
	 * @param   mixed    new value
	 * @return  mixed
	 */
	public function offsetSet($key, $value)
	{
		if (!$this->offsetExists($key))
		{
			// Insert a new value
			DB::insert($this->_database_table, array('config_group', 'config_key', 'config_value'))->values(array($this->_configuration_group, $key, serialize($value)))
				->execute($this->_database_instance);
		}
		elseif ($this->offsetGet($key) !== $value)
		{
			// Update the value
			DB::update($this->_database_table)->value('config_value', serialize($value))
				->where('config_group', '=', $this->_configuration_group)
				->where('config_key', '=', $key)
				->execute($this->_database_instance);
		}
		
		return parent::offsetSet($key, $value);
	}

} // End Kohana_Config_Database
