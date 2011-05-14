<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Theme extends Model
{

    /**
     * @todo Eindeutiger Verbesserungsbedarf !!!
     */
    public function load()
    {
        // Get configured themes
        $frontend = Kohana::config('ilch.default_frontend_theme');
        $backend = Kohana::config('ilch.default_backend_theme');
        
        // Load first the ilchcms theme and then the others
        Kohana::modules(Kohana::modules() + array(
            'theme'.DIRSEPA.'ilchcms' => CONTENT.'core'.DIRSEPA.'themes'.DIRSEPA.'ilchcms',
            'theme'.DIRSEPA.'frontend' => CONTENT.'themes'.DIRSEPA.$frontend,
            'theme'.DIRSEPA.'backend' => CONTENT.'themes'.DIRSEPA.$backend
        ));
    }

}