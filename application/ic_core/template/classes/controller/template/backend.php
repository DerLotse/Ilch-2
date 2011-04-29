<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Backend-Spezifische Dinge kommen später hier rein. (z.B. Adminrechte, Adminmenü,...)
 */
class Controller_Template_Backend extends Controller_Template_General
{

    // Festlegen des Templates
    public $template = 'backend/index';

    public function before()
    {
        // Run anything that need ot run before this.
        parent::before();
        
        #Open session
        $this->session= Session::instance();

        // Add Styles by Config
        $theme_styles = Kohana::config('backend.theme.styles');
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
