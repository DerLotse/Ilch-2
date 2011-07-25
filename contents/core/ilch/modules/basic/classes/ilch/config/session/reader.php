<?php
defined('SYSPATH') or die('No direct script access.');

/**
 * Session-based configuration loader.
 *
 * @package    Ilch/Base
 * @category   Configuration
 * @author     Ilch Team
 * @copyright  (c) 2011 Ilch Team
 * @license    http://kohanaphp.com/license
 */
class Ilch_Config_Session_Reader implements Kohana_Config_Reader {

	/**
	 * Look session dada for config values.
	 *
	 * @param   string  group name
	 * @return  array|boolean
	 */
	public function load($group)
	{
		if ($group === 'database' or $group === 'session')
		{
			return FALSE;
		}
		
		return Arr::get(Session::instance()->get('user_config', array()), $group, FALSE);
	}
}
