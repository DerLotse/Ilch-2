<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Permission extends Controller_Frontend {

	public function action_denied()
	{
		// Get type
		$type = $this->request->param(0, NULL);
		
		$this->template->title = 'Zugriff verweigert';
		
		if ($type == 'login')
		{
			$this->template->content = View::factory('frontend/permission/denied/login');
		}
		else
		{
			$this->template->content = View::factory('frontend/permission/denied/index');
		}
	}
}