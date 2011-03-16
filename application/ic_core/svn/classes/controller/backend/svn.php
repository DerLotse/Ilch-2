<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Backend_Svn extends Controller
{

    /**
     * Check for updates
     */
    public function action_index()
    {

        $this->_return_updates();
//        UPDATE::database(1);
        // Wenn erster Aufruf
        if (FIRST_RUN === TRUE)
        {
            $act_revision = 0;
        }
        else
        {
            $act_revision = DB::select()->from('svn')->order_by('id', 'DESC')->limit(1)->execute()->get('revision', 0);
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
                DB::insert('svn', array('revision', 'time'))->values(array($revision, time()))->execute();
                $act_revision = $revision;
            }
        }

        // Load a template
        $this->response->body(View::factory('backend/svn/index')->bind('revision', $act_revision));
    }

    /**
     * Gibt einen Array mit neuen Update-Files zurück
     */
    private function _return_updates()
    {
        // Array erstellen
        $revisions = Array();

        // Ordner definieren
        $dir = IC_MODPATH.IC_CORE.'svn/classes/updates/';

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
