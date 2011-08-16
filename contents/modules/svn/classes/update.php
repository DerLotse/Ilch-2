<?php

defined('SYSPATH') or die('No direct script access.');

class Update
{

    /**
     * Führt eine SQL-Datei aus
     * @param integer $revision Revision number
     */
    public static function database($revision)
    {
    	// Temporary variable, used to store current query
		$cache = '';
		
		// Read in entire file
		$lines = file(MODPATH.'modules'.DIRSEPA.'svn'.DIRSEPA.'updates'.DIRSEPA.'revision_'.$revision.'.sql');
		
		// Get prefix
		$prefix = Kohana::$config->load('database');
		$prefix = $prefix[Database::$default]['table_prefix'];
		
		// Loop through each line
		foreach ($lines as $line)
		{
		    // Skip it if it's a comment
		    if (substr($line, 0, 2) == '--' || $line == '')
		        continue;
		 
		    // Replace prefix
		    $line = str_replace('$prefix_', $prefix, $line);
		        
		    // Add this line to the current segment
		    $cache .= $line;
		    
		    // If it has a semicolon at the end, it's the end of the query
		    if (substr(trim($line), -1, 1) == ';')
		    {
		        // Perform the query
		        DB::query(NULL, $cache)->execute();

		    	// Reset temp variable to empty
		        $cache = '';
		    }
		}
    }

}