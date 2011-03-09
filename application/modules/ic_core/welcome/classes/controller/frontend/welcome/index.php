<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Welcome_Index extends Controller {

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
		$this->response->body(View::factory('frontend/welcome/index'));
	}

} // End Welcome
