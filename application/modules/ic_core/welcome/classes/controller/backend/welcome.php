<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Backend_Welcome extends Controller {

        /**
         * Test function
         * @param string $options Function-Options from URL
         */
	public function action_index($options = '')
	{
                // Explode Options from URL
                $options = explode('/', $options);

                // Return Options-Array
                print_r($options);

                // Load a template
		$this->response->body(View::factory('welcome_backend'));
	}

} // End Welcome