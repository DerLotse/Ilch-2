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
        $act_revision = DB::select()->from('settings')->where('name', '=', 'svn_revision')->execute()->get('value', 0);

        // Load a template
        return View::factory('widget/svn/index', array('revision' => $act_revision));
    }

}

// End Welcome