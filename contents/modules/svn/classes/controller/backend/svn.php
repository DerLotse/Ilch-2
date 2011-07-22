<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Backend_Svn extends Controller {

	/**
	 * Prüft auf Updates
	 */
	public function action_index()
	{
		// Update ausführen
		$revision = $this->_make_update(Kohana::config('ilch.svn_version'));
		
		// Load a template
		$this->response->body(View::factory('backend/svn/index')->bind('revision', $revision));
	}

	/**
	 * Löscht eventuelle Tabellen und legt neue an
	 */
	public function action_first_run()
	{
		// Tabellen löschen, wenn welche Vorhanden sind
		$this->_make_reset();
		
		// Tabellen erstellen
		$revision = $this->_make_update();
		
		// Load a template
		$this->response->body(View::factory('backend/svn/first_run')->bind('revision', $revision));
	}

	/**
	 * Löscht alle Tabellen und legt diese neu an
	 */
	public function action_reset($first_run = FALSE)
	{
		// Tabellen löschen
		$this->_make_reset();
		
		// Tabellen neu erstellen
		$revision = $this->_make_update();
		
		// Load a template
		$this->response->body(View::factory('backend/svn/reset')->bind('revision', $revision));
	}

	/**
	 * Installiert Datenbank-Updates
	 * @param integer Letzte Rev.
	 */
	private function _make_update($last_rev = 0)
	{
		// Abrufen von Updates
		$updates = $this->_return_updates();
		
		// Durchlaufen von Updates
		foreach ($updates as $revision)
		{
			// Alte Updates filtern
			if ($revision > $last_rev)
			{
				// SQL-Update durchführen
				UPDATE::database($revision);
				
				// Wenn Datenbankstruktur bereits richtg
				if ($revision >= 54)
				{
					// Neue Revision speichern
					DB::update('config')->set(array('config_value' => serialize($revision)))
						->where('config_key', '=', 'svn_version')
						->and_where('config_group', '=', 'ilch')
						->execute();
				}
				
				// Sichere neue letzte Rev.
				$last_rev = $revision;
			}
		}
		
		// Leere Konfiguration Cache
		if (CACHE_ENABLED === TRUE) Cache::instance()->delete('database_config');
		
		return $last_rev;
	}

	/**
	 * Löscht alle Tabellen
	 */
	private function _make_reset()
	{
		// Get all Tables
		$query = Database::instance()->list_tables();
		
		foreach ($query as $row)
		{
			// Drop table
			DB::query(NULL, 'DROP table ' . $row)->execute();
		}
	}

	/**
	 * Gibt einen Array mit neuen Update-Files zurück
	 */
	private function _return_updates()
	{
		// Array erstellen
		$revisions = Array();
		
		// Ordner definieren
		$dir = MODPATH . 'modules' . DIRSEPA . 'svn' . DIRSEPA . 'updates';
		
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
				$file = basename($dir . DIRSEPA . $file, '.' . $file_info["extension"]);
				
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