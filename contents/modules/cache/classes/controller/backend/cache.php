<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Backend_Cache extends Controller_Backend {

	public function action_index()
	{
        // Set Title
        $this->template->title = 'Cache leeren';
		
		Cache::instance()->delete_all();
		
		$this->template->content = View::factory('backend/cache/index');
	}
}