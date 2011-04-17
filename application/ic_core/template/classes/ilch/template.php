<?php

defined('SYSPATH') or die('No direct script access.');

class Ilch_Template {

    public $version = '0.0.2';

    /**
     * @todo write Dokumentation
     */
    public static function loader() {
        // Get active modules
        $result = DB::select('folder')
                        ->from('themes')
                        ->where('active', '=', 1)
                        ->execute()->as_array();

        // Create empty modul array
        $mod_array = array();

        // Fill modul array
        foreach ($result AS $value) {
            // Save modul values
            $mod_array[IC_THEMES . $value['folder']] = IC_THEMES . $value['folder'];
        }

        // New modules instance
        Kohana::modules(Kohana::modules() + $mod_array);
    }

}