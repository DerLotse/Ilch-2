<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Welcome extends Controller_Frontend {

	public function action_index()
	{
		// Set Title
		$this->template->title = 'Hello World';

		// Load a template
		$this->template->content = View::factory('frontend/welcome/index', array('title' => $this->template->title));
	}

} // End Welcome
