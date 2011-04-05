<?php

defined('SYSPATH') or die('No direct script access.');

class Module_Loader extends Module
{

    /**
     * @todo write Dokumentation
     */
    public static function instance()
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