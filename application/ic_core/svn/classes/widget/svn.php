<?php

defined('SYSPATH') or die('No direct script access.');

class Widget_Svn extends Widget
{

    /**
     * Check for updates
     */
    public static function action_index()
    {
        // Find the SVN DB-Version
        $act_revision = DB::select()->from('svn')->order_by('id', 'DESC')->limit(1)->execute()->get('revision', 0);

        // Load a template
        return View::factory('widget/svn/index', array('revision' => $act_revision));
    }

}

// End Welcome