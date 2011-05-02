<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Backend_Svn extends Controller
{

    /**
     * Check for updates
     */
    public function action_index($first_run = FALSE)
    {
        // Wenn erster Aufruf
        if (FIRST_RUN === TRUE OR $first_run === TRUE)
        {
            $act_revision = 0;
        }
        else
        {
            $act_revision = DB::select()->from('settings')->where('name', '=', 'svn_revision')->execute()->get('value', 0);
        }

        // Abrufen von Updates
        $updates = $this->_return_updates();

        // Durchlaufen von Updates
        foreach ($updates AS $revision)
        {
            // Alte Updates filtern
            if ($revision > $act_revision)
            {
                // SQL-Update durchführen
                UPDATE::database($revision);

                // Neue Revision speichern
                if ($revision >= 41) DB::update('settings')->set(array('value' => $revision))->where('name', '=', 'svn_revision')->execute();
                $act_revision = $revision;
            }
        }

        // Load a template
        $this->response->body(View::factory('backend/svn/index')->bind('revision', $act_revision));
    }
    
    /**
     * Löscht alle Tabellen und legt diese neu an
     */
    public function action_reset($first_run = FALSE)
    {
        // Get all Tables
        $query = Database::instance()->list_tables();

        foreach ($query AS $row)
        {
            // Drop table
            DB::query(NULL, 'DROP table '.$row)->execute();
        }
        
        // Create tables
        $this->action_index(TRUE);
        
        // Hinweis
        if($first_run === FALSE) $this->response->body('<h1 style="color: green;">Datenbank wurde neu generiert!</h1><p><a href="'.URL::site().'">Weiter zur Startseite</a></p>');
    }

    /**
     * Gibt einen Array mit neuen Update-Files zurück
     */
    private function _return_updates()
    {
        // Array erstellen
        $revisions = Array();

        // Ordner definieren
        $dir = IC_CORE.'svn/updates/';

        // Ordner öffnen
        $open = opendir($dir);

        // Ordnerinhalt durchlaufen
        while ($file = readdir($open))
        {
            // Dateiinfo beziehen
            $file_info = pathinfo($file);

            // Prüfen, ob gültige Datei
            if (preg_match("/^revision_[0-9]+.sql$/", $file))
            {
                // Dateiname ohne Extension
                $file = basename($dir.'/'.$file, '.'.$file_info["extension"]);

                // Revision finden
                $revision = explode('_', $file);
                $revision = $revision[1];

                // Rückgabewert
                $revisions[$file] = $revision;
            }
        }

        // Ordner schließen
        closedir($open);

        // Werte ordnen
        asort($revisions);

        // Werte zurückgeben
        return ($revisions);
    }

}

// End Welcome
