<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Backend_Welcome extends Controller {

        /**
         * Test function
         * @param string $options Function-Options from URL
         */
	public function action_index($fname = '', $sname = '')
	{
                // Load a template
		$this->response->body(View::factory('backend/welcome/index'));
	}

} // End Welcome
