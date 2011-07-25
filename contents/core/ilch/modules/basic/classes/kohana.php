<?php
defined('SYSPATH') or die('No direct script access.');

class Kohana extends Kohana_Core {

	/**
	 * Searches for a file in the [Cascading Filesystem](kohana/files), and
	 * returns the path to the file that has the highest precedence, so that it
	 * can be included.
	 *
	 * When searching the "config", "messages", or "i18n" directories, or when
	 * the `$array` flag is set to true, an array of all the files that match
	 * that path in the [Cascading Filesystem](kohana/files) will be returned.
	 * These files will return arrays which must be merged together.
	 *
	 * If no extension is given, the default extension (`EXT` set in
	 * `index.php`) will be used.
	 *
	 * // Returns an absolute path to views/template.php
	 * Kohana::find_file('views', 'template');
	 *
	 * // Returns an absolute path to media/css/style.css
	 * Kohana::find_file('media', 'css/style', 'css');
	 *
	 * // Returns an array of all the "mimes" configuration files
	 * Kohana::find_file('config', 'mimes');
	 *
	 * @param   string   directory name (views, i18n, classes, extensions, etc.)
	 * @param   string   filename with subdirectory
	 * @param   string   extension to search for
	 * @param   boolean  return an array of files?
	 * @return  array    a list of files when $array is TRUE
	 * @return  string   single file path
	 */
	public static function find_file($dir, $file, $ext = NULL, $array = FALSE)
	{
		if ($ext === NULL)
		{
			// Use the default extension
			$ext = EXT;
		}
		elseif ($ext)
		{
			// Prefix the extension with a period
			$ext = ".{$ext}";
		}
		else
		{
			// Use no extension
			$ext = '';
		}
		
		// Create a partial path of the filename
		$path = $dir . DIRECTORY_SEPARATOR . $file . $ext;
		
		if (Kohana::$caching === TRUE and isset(Kohana::$_files[$path . ($array ? '_array' : '_path')]))
		{
			// This path has been cached
			return Kohana::$_files[$path . ($array ? '_array' : '_path')];
		}
		
		if (Kohana::$profiling === TRUE and class_exists('Profiler', FALSE))
		{
			// Start a new benchmark
			$benchmark = Profiler::start('Kohana', __FUNCTION__);
		}
		
		if ($array or $dir === 'config' or $dir === 'i18n' or $dir === 'messages')
		{
			// Include paths must be searched in reverse
			$paths = array_reverse(Kohana::$_paths);
			
			// Array of files that have been found
			$found = array();
			
			foreach ($paths as $dir)
			{
				if (is_file($dir . $path))
				{
					// This path has a file, add it to the list
					$found[] = $dir . $path;
				}
			}
		}
		else
		{
			// The file has not been found yet
			$found = FALSE;
			
			foreach (Kohana::$_paths as $dir)
			{
				if (is_file($dir . $path))
				{
					// A path has been found
					$found = $dir . $path;
					
					// Stop searching
					break;
				}
			}
		}
		
		if (Kohana::$caching === TRUE and strpos($dir, DIRSEPA . 'themes' . DIRSEPA) === FALSE)
		{
			// Add the path to the cache
			Kohana::$_files[$path . ($array ? '_array' : '_path')] = $found;
			
			// Files have been changed
			Kohana::$_files_changed = TRUE;
		}
		
		if (isset($benchmark))
		{
			// Stop the benchmark
			Profiler::stop($benchmark);
		}
		
		return $found;
	}
}