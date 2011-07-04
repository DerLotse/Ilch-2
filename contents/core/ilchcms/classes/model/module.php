<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Module extends Model
{

    public function load()
    {
        // Get active modules
        $result = DB::select('module_core', 'module_name')
                        ->from('modules')
                        ->where('module_active', '=', 1)
                        ->order_by('module_core', 'ASC')
                        ->order_by('module_name', 'ASC')
                        ->execute()->as_array();

        // Create empty modul array
        $mod_array = array(
            'core' => array(),
            'custom' => array()
        );
        
        // Set Module paths
        $mod_paths = array(
            'core' => CONTENT.'core'.DIRSEPA,
            'custom' => CONTENT.'modules'.DIRSEPA
        );

        // Fill module array
        foreach ($result AS $row)
        {
            // Define modul path
            $mod_core = ($row['module_core'] == 1) ? 'core' : 'custom';
            $mod_path = $mod_paths[$mod_core].$row['module_name'];
            
            // Save modul details
            $mod_array[$mod_core][$mod_core.DIRSEPA.$row['module_name']] = $mod_path;
        }

        // New modules instance
        Kohana::modules($mod_array['custom'] + Kohana::modules() + $mod_array['core']);
    }

}