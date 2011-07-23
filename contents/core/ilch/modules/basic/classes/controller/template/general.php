<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Hier kommt alles rein, was für den Frontend-Bereich gilt sowie für den Backend-bereich
 */
class Controller_Template_General extends Controller_Template {

	public $auth_required = FALSE;

	public $permissions_required = FALSE;

	/**
	 * Initialize properties before running the controller methods (actions),
	 * so they are available to our action.
	 */
	public function before()
	{
		// Run anything that need ot run before this.
		parent::before();
		
		// Get current action
		$action_name = $this->request->action();
		
		// Check for auth status
		if (($this->auth_required === TRUE or (is_array($this->auth_required) and in_array($action_name, $this->auth_required))) and User::auth()->logged_in() === FALSE)
		{
			Session::instance()->set('login_redirect', URL::site($this->request->uri()));
			$this->request->redirect('permission/denied/login');
		}
		
		// Check for permissions
		if ($this->permissions_required !== FALSE and isset($this->permissions_required[$action_name]) === TRUE and Permission::has($this->permissions_required[$action_name]) === FALSE)
		{
			$this->request->redirect('permission/denied');
		}
		
		if ($this->auto_render)
		{
			// Initialize empty values
			$this->template->title = '';
			$this->template->meta_keywords = '';
			$this->template->meta_description = '';
			$this->template->meta_copywrite = '';
			$this->template->content = '';
			$this->template->styles = array();
			$this->template->scripts = array();
		}
	}

	/**
	 * Fill in default values for our properties before rendering the output.
	 */
	public function after()
	{
		// Run anything that needs to run after this.
		parent::after();
	}

}
