<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Backend_Welcome extends Controller_Backend
{

    /**
     * Test function
     * @param string $options Function-Options from URL
     */
    public function action_index($fname = '', $sname = '')
    {
        // Set Title
        $this->template->title = 'Hello World';

        // Load a template
        $this->template->content = View::factory('backend/welcome/index', array('title' => $this->template->title));
    }

}

// End Welcome
