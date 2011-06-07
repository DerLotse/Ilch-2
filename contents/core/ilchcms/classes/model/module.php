<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Module extends Model
{

    public function load()
    {
        // Get active modules
        $result = DB::select('core', 'name')
                        ->from('modules')
                        ->where('active', '=', 1)
                        ->order_by('core', 'ASC')
                        ->order_by('name', 'ASC')
                        ->execute()->as_array();

        // Create empty modul array
        $mod_array = array();
        
        // Set Module paths
        $mod_paths = array(
            'core' => CONTENT.'core'.DIRSEPA,
            'custom' => CONTENT.'modules'.DIRSEPA
        );

        // Fill module array
        foreach ($result AS $row)
        {
            // Define modul path
            $mod_core = ($row['core'] == 1) ? 'core' : 'custom';
            $mod_path = $mod_paths[$mod_core].$row['name'];
            
            // Save modul details
            $mod_array[$mod_core.DIRSEPA.$row['name']] = $mod_path;
        }

        // New modules instance
        Kohana::modules($mod_array + Kohana::modules());
    }

}