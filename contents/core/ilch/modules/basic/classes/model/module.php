<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Module extends Model
{

    /*
     * @TODO Use Cache-Library for a better performance
     */
    public function load()
    {
        // Get active modules
        $result = DB::select('module_directory', 'module_name')
                        ->from('modules')
                        ->where('module_active', '=', 1)
                        //->order_by('module_name', 'ASC') // @TODO Order by position
                        ->execute()->as_array();

        // Create empty modul array
        $module_array = array(
            'core' => array(),
            'custom' => array()
        );

        // Fill module array
        foreach ($result AS $row)
        {
            // If directory not empty
            if (empty($row['module_directory']) === FALSE)
            {
                // Split directory value
                $directory = explode('_', $row['module_directory']);
                
                // Set module type
                $module_type = ($directory[0] == 'core') ? 'core' : 'custom';
                
                // Get module path
                $module_path = implode(DIRSEPA, $directory).DIRSEPA.'modules'.DIRSEPA.$row['module_name'];
            }
            else
            {
                // Set module type
                $module_type = 'custom';
                
                // Get module path
                $module_path = 'modules'.DIRSEPA.$row['module_name'];
            }
                        
            // Save modul details
            $module_array[$module_type][str_replace(DIRSEPA, '_', $module_path)] = MODPATH.$module_path;
        }
        
        // New modules instance
        Kohana::modules($module_array['custom'] + Kohana::modules() + $module_array['core']);
    }
}