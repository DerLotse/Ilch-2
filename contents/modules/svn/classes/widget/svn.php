<?php

defined('SYSPATH') or die('No direct script access.');

class Widget_Svn extends Widget
{

    /**
     * Check for updates
     */
    public static function get()
    {
        // Find the SVN DB-Version
        $act_revision = Kohana::config('ilch.svn_version');

        // Load a template
        return View::factory('widget/svn/index', array('revision' => $act_revision));
    }

}

// End Welcome