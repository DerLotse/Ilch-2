<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Hier kommt alles rein, was für den Frontend-Bereich gilt sowie für den Backend-bereich
 */
class Controller_Template_General extends Controller_Template {

    /**
     * Initialize properties before running the controller methods (actions),
     * so they are available to our action.
     */
    public function before()
    {
        // Run anything that need ot run before this.
        parent::before();

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
