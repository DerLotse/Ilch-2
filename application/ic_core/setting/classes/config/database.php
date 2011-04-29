<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Database-based configuration loader.
 *
 * Schema for configuration table:
 *
 *     group_name    varchar(128)   // Edit: module varchar(32)
 *     config_key    varchar(128)   // Edit: name   varchar(32)
 *     config_value  text           // Edit: value  text
 *     primary key   (group_name, config_key)   // Edit: id
 *
 * @package    Kohana/Database
 * @category   Configuration
 * @author     Kohana Team
 * @copyright  (c) 2009 Kohana Team
 * @license    http://kohanaphp.com/license
 */
class Config_Database extends Kohana_Config_Database {

	protected $_database_table = 'settings';

	public function __construct(array $config = NULL)
	{
		parent::__construct();
	}

	/**
	 * Query the configuration table for all values for this group and
	 * unserialize each of the values.
	 *
	 * @param   string  group name
	 * @param   array   configuration array
	 * @return  $this   clone of the current object
	 */
	public function load($group, array $config = NULL)
	{
		if ($config === NULL AND $group !== 'database')
		{
			// Load all of the configuration values for this group
			$query = DB::select('name', 'value')
				->from($this->_database_table)
				->where('module', '=', $group)
				->execute($this->_database_instance);

			if (count($query) > 0)
			{
				// Unserialize the configuration values
				$config = $query->as_array('name', 'value');
			}
		}

		return Config_Reader::load($group, $config);
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
		if ( ! $this->offsetExists($key))
		{
			// Insert a new value
			DB::insert($this->_database_table, array('module', 'name', 'value'))
				->values(array($this->_configuration_group, $key, serialize($value)))
				->execute($this->_database_instance);
		}
		elseif ($this->offsetGet($key) !== $value)
		{
			// Update the value
			DB::update($this->_database_table)
				->value('value', serialize($value))
				->where('module', '=', $this->_configuration_group)
				->where('name', '=', $key)
				->execute($this->_database_instance);
		}

		return Config_Reader::offsetSet($key, $value);
	}

} // End Kohana_Config_Database
