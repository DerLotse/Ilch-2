<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Theme extends Model
{

    /**
     * 
     */
    public function load($controller = 'frontend')
    {
        $theme = Kohana::config('ilch.default_'.$controller.'_theme');
        
        // Load first the ilchcms theme and then the others
        Kohana::modules(array(
            $theme => MODPATH.str_replace('_', DIRSEPA, $theme)
        ) + Kohana::modules());
    }

}