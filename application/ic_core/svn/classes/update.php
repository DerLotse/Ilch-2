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
        // Load SQL-File
        $sql_file = file_get_contents(IC_MODPATH.IC_CORE.'svn/classes/updates/revision_'.$revision.'.sql');

        // Edit SQL-File
        $sql_file = preg_replace("/(\015\012|\015|\012)/", "\n", $sql_file);
        $sql_statements = explode(";\n", $sql_file);

        // Database-Queries
        foreach ($sql_statements as $sql_statement)
        {
            if (trim($sql_statement) != '')
            {
                // Datebase-Query
                DB::query(NULL, $sql_statement)->execute();
            }
        }
    }

}