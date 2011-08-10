<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Backend_News extends Controller_Backend
{

    /**
     * Test function
     * @param string $options Function-Options from URL
     */
    public function action_index()
    {
        // Set Title
        $this->template->title = 'News administration';

        // Load a template
        $this->template->content = View::factory('backend/news/index', array('title' => $this->template->title));
    }

}