<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Theme extends Model
{

    /**
     * 
     */
    public function load()
    {
        // Get configured themes
        $frontend = Kohana::config('ilch.default_frontend_theme');
        $backend = Kohana::config('ilch.default_backend_theme');
        
        // Load first the ilchcms theme and then the others
        Kohana::modules(array(
            'theme'.DIRSEPA.'frontend' => MODPATH.'themes'.DIRSEPA.$frontend,
            'theme'.DIRSEPA.'backend' => MODPATH.'themes'.DIRSEPA.$backend
        ) + Kohana::modules());
    }

}