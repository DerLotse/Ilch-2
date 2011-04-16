<?php

defined('SYSPATH') or die('No direct script access.');

class Ilch_Module {
    
    public $version = '0.0.2';
    
    /**
     * Define some default routes
     * @param type $uri
     * @return type 
     */
    public static function route($uri)
    {
        // Wenn Backend
        if (preg_match('#^backend(?:/(?P<controller>[^/.,;?\n]++)(?:/(?P<action>[^/.,;?\n]++)(?:/(?P<overflow>(.*?)))?)?)?$#uD', $uri, $match))
        {
            // Controller
            $controller = (isset($match[1]) === TRUE) ? $match[1] : 'welcome';

            // Action
            $action = (isset($match[2]) === TRUE) ? $match[2] : 'index';

            // Overflow
            $overflow = (isset($match[3]) === TRUE) ? explode('/', $match[3]) : array();

            return array(
                'directory' => 'backend/',
                'controller' => $controller,
                'action' => $action
            )+$overflow;
        }
        // Wenn Frontend
        else if (preg_match('#^(?:(?P<controller>[^/.,;?\n]++)(?:/(?P<action>[^/.,;?\n]++)(?:/(?P<overflow>(.*?)))?)?)?$#uD', $uri, $match))
        {
            // Controller
            $controller = (isset($match[1]) === TRUE) ? $match[1] : 'welcome';

            // Action
            $action = (isset($match[2]) === TRUE) ? $match[2] : 'index';

            // Overflow
            $overflow = (isset($match[3]) === TRUE) ? explode('/', $match[3]) : array();

            return array(
                'directory' => 'frontend/',
                'controller' => $controller,
                'action' => $action
            )+$overflow;
        }
    }
    
    /**
     * @todo write Dokumentation
     */
    public static function loader()
    {
        // Get active modules
        $result = DB::select('folder', 'core')
                        ->from('modules')
                        ->where('active', '=', 1)
                        ->order_by('core', 'ASC')
                        ->execute()->as_array();

        // Create empty modul array
        $mod_array = array();

        // Fill modul array
        foreach ($result AS $value)
        {
            // Set modul type
            $mod_type = ($value['core'] == 1) ? IC_CORE : IC_CUSTOM;

            // Assemble module path
            $module_path = $mod_type.$value['folder'];

            // Save modul values
            $mod_array[$module_path] = $module_path;
        }

        // New modules instance
        Kohana::modules(Kohana::modules() + $mod_array);
    }
    
}
