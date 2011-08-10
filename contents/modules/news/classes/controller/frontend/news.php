<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_News extends Controller_Frontend {

	public function action_index()
	{
		// Set Title
		$this->template->title = 'News';

		// Load a template
		$this->template->content = View::factory('frontend/news/index', array('title' => $this->template->title));
	}

}