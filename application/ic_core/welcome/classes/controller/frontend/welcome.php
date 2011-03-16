<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Welcome extends Controller {

        /**
         * Test function
         * @param string $options Function-Options from URL
         */
	public function action_index($options = '')
	{
                // Load a template
		$this->response->body(View::factory('frontend/welcome/index'));
	}

} // End Welcome
