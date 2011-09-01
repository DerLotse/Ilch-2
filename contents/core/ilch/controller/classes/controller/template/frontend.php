<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Frontend-Spezifische Dinge kommen später hier rein. (z.B. Menü-, Boxen-Ausgabe)
 */
class Controller_Template_Frontend extends Controller_Template_General {

	// Festlegen des Templates
	public $template = 'index';

	public function before()
	{
		// Load Template
		Model::factory('theme')->load('frontend');
		
		// Run anything that need ot run before this.
		parent::before();
		
		// Add Styles by Config
		$theme_styles = Kohana::$config->load('frontend')->theme['styles'];
		if (is_array($theme_styles) && count($theme_styles) >= 1)
		{
			$this->template->styles = array_merge($this->template->styles, $theme_styles);
		}
	}

	public function after()
	{
		// Run anything that needs to run after this.
		parent::after();
	}

}
