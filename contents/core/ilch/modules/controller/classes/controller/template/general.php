<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Hier kommt alles rein, was für den Frontend-Bereich gilt sowie für den Backend-bereich
 */
class Controller_Template_General extends Controller_Template {

	public static $auth_required = FALSE;

	public static $permissions_required = FALSE;

	/**
	 * Initialize properties before running the controller methods (actions),
	 * so they are available to our action.
	 */
	public function before()
	{
		// Run anything that need ot run before this.
		parent::before();
		
		// Check Permission
		static::access_permission($this->request->action());
		
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

	/**
	 * Prüft ob Berechtigungen für Controller-Action vorhanden sind. Kann außerhalb des Controllers abgerufen werden.
	 * @param string $action Name der Action-Funktion
	 * @param boolean $redirect Weiterleitung oder Wahrheitswert
	 */
	public static function access_permission($action, $redirect = TRUE)
	{
		// Check for auth status
		if ((static::$auth_required === TRUE or (is_array(static::$auth_required) and in_array($action, static::$auth_required))) and User::auth()->logged_in() === FALSE)
		{
			if ($redirect === TRUE)
			{
				Session::instance()->set('login_redirect', URL::site($this->request->uri()));
				Request::initial()->redirect('permission/denied/login');
			}
			else
			{
				return FALSE;
			}
		}
		
		// Check for permissions
		if (static::$permissions_required !== FALSE and isset(static::$permissions_required[$action]) === TRUE and User::permission()->has(static::$permissions_required[$action]) === FALSE)
		{
			if ($redirect === TRUE)
			{
				Request::initial()->redirect('permission/denied');
			}
			else
			{
				return FALSE;
			}
		}
		
		// Nothing happens
		return TRUE;
	}

}
