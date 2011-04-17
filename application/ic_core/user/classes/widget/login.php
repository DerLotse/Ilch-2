<?php

defined('SYSPATH') or die('No direct script access.');

class Widget_Login extends Widget
{

    /**
     * Check for updates
     */
    public static function action_index()
    {
        // Load a template
        return View::factory('widget/user/login');
    }

}