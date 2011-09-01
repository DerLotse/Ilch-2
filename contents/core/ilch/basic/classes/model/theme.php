<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Theme extends Model
{

    /**
     * 
     */
    public function load($controller = 'frontend')
    {
    	$controller = 'default_'.$controller.'_theme';
        $theme = Kohana::$config->load('ilch')->$controller;
        
        // Load first the ilchcms theme and then the others
        Kohana::modules(array(
            $theme => MODPATH.str_replace('_', DIRSEPA, $theme)
        ) + Kohana::modules());
    }

}