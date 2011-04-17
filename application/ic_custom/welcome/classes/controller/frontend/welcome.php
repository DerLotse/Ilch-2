<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Welcome extends Controller_Frontend {

	/**
	 * Test function
	 * @param string $options Function-Options from URL
	 */
	public function action_index($options = '')
	{
		// Set Title
		$this->template->title = 'Hello World';

		// Load a template
		$this->template->content = View::factory('frontend/welcome/index', array('title' => $this->template->title));
	}

} // End Welcome
