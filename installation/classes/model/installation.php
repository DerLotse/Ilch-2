<?php

class Model_Installation extends Model
{

    /**
     * Return possible application directories
     */
    public function application_directories()
    {
        // Open Directory
        $directory = opendir(DOCROOT);

        // Cache for results
        $directories = array();

        while ($name = readdir($directory))
        {
            if (is_dir($name) === TRUE AND in_array($name, array('.svn', 'system', 'installation', 'contents', '..', '.')) === FALSE)
            {
                if (file_exists($name . DIRSEPA . 'config' . DIRSEPA . 'database' . EXT) === FALSE)
                    $directories[$name] = $name;
            }
        }

        // Return results
        return $directories;
    }

    /**
     * Return available pdo drivers
     */
    public function pdo_drivers()
    {
        // Create Array
        $drivers = array();

        // Check if available
        if (class_exists('PDO') === FALSE)
            return $drivers;

        // Supported drivers
        $supported_drivers = array(
            'cubrid' => 'Cubrid (beta support)',
            'dblib' => 'Microsoft SQL Server (experimental support)',
            'mysql' => 'MySQL 3.x/4.x/5.x (beta support)',
            'oci' => 'Oracle Call Interface (experimental support)',
            'pgsql' => 'PostgreSQL (beta support)'
        );

        // Get available drivers
        $available_drivers = PDO::getAvailableDrivers();

        foreach ($available_drivers AS $driver)
        {
            if (isset($supported_drivers[$driver]) === TRUE)
                $drivers[$driver] = $supported_drivers[$driver];
        }

        // Add field for own PDO DSN
        $drivers['own'] = __('Set own PDO DSN');

        return $drivers;
    }

    /**
     * Return array value with value_prefix
     * @param array $array
     * @param string $key
     * @param string $default
     * @param string $value_prefix
     * @return string 
     */
    function get_value($array, $key, $default = FALSE, $value_prefix = '')
    {
        $value = Arr::get($array, $key, $default);
        return (empty($value) === TRUE) ? $default : $value_prefix . $value;
    }

    /**
     * Return supportet hash algos
     */
    function hash_algos()
    {
        $algos = array(
            'md5_ilch' => 'md5 (' . __('Compatible with Ilch 1.1') . ')'
        );

        foreach (hash_algos() AS $value)
        {
            $algos[$value] = $value;
        }

        ksort($algos);

        return $algos;
    }

    /**
     * Create a config file
     * @param string $application
     * @param string $configuration the name of the configuration file without extention
     * @param mixed $data config file content
     */
    function create_config($application, $configuration, $data)
    {
        // Create path
        $file_path = DOCROOT . $application . DIRSEPA . 'config' . DIRSEPA . $configuration . EXT;

        // Create content
        switch ($configuration)
        {
            case 'database':
                $content = "<?php defined('SYSPATH') or die('No direct access allowed.');\n\nreturn array('default' =>" . var_export($data, TRUE) . ");";
                break;

            default:
                $content = "<?php defined('SYSPATH') or die('No direct access allowed.');\n\n".$data;
                break;
        }

        // Create file
        return @file_put_contents($file_path, $content);
    }

    function import_sql($prefix)
    {
		// Temporary variable, used to store current query
		$cache = '';
		
		// Read in entire file
		$lines = file(APPPATH.'sql'.DIRSEPA.'installation.sql');
		
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
    
    function create_key($lenght = 36)
    {
		//Zeichen, die vorkommen können
		$characters = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+-*#!$%&/()=?';
	
		$random_string = '';
		
		$count_characters = strlen($characters);
		
		for($i=0; $i < $lenght; $i++)
		{
			$random_string .= $characters[mt_rand(0, $count_characters - 1)];
		}
		
		return $random_string;
    }
    
}