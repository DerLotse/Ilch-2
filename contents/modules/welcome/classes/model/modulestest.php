<?php

class Model_Modulestest extends Model
{

    protected $_modules = array();
    protected $_config;
    protected $_placed_modules = array();
    protected $_placed_modules_pos = array();

    function __construct()
    {
        $this->_config = (array) Kohana::$config->load('module');
    }

    function modules($modules)
    {
        // Return data
        if (!is_array($modules))
            return $this->_modules;

        // Save data
        $this->_modules = $modules;
    }

    function config($config)
    {
        // Return data
        if (!is_array($config))
            return $this->_config;

        // Save data
        $this->_config = $config;
    }

    function place_module(array $module)
    {
        // Modulposition
        $position = NULL;

        // Place using dependencies data
        if (isset($this->_config[$module[0]]['dependencies']))
        {
            foreach ($this->_config[$module[0]]['dependencies'] AS $dependence)
            {
                // Check if module is loaded and module exists
                if (!isset($this->_placed_modules[$dependence]) AND isset($this->_modules[$dependence]))
                {
                    // Place module
                    $this->place_module(array($dependence, $this->_modules[$dependence]));
                }
            }
        }

        // Place using extends data
        if (isset($this->_config[$module[0]]['extends']))
        {
            foreach ($this->_config[$module[0]]['extends'] AS $extend)
            {
                // Check if module is loaded and module exists
                if (!isset($this->_placed_modules[$extend]) AND isset($this->_modules[$extend]))
                {
                    // Place module
                    $this->place_module(array($extend, $this->_modules[$extend]));
                }

                if (isset($this->_placed_modules_pos[$extend]) AND ($position === NULL OR $this->_placed_modules_pos[$extend] < $position))
                {
                    $position = $this->_placed_modules_pos[$extend];
                }
            }
        }

        if ($position === NULL)
        {
            $this->_placed_modules[$module[0]] = $module[1];
        }
        else
        {
            $this->_placed_modules = $this->array_extend($this->_placed_modules, $position, array($module[0], $module[1]));
        }

        // Set new statistic
        $this->_placed_modules_pos = array_flip(array_keys($this->_placed_modules));
    }

    function execute()
    {
        foreach ($this->_modules AS $key => $value)
        {
            if (!isset($this->_placed_modules[$key]))
                $this->place_module(array($key, $value));
        }

        print_r($this->_placed_modules);
    }

    function array_extend($array, $position, $insert_array)
    {
        $i = 0;
        $new_array = array();

        foreach ($array AS $key => $value)
        {
            if ($position == $i)
                $new_array[$insert_array[0]] = $insert_array[1];
            $new_array[$key] = $value;
            $i++;
        }

        if (!isset($new_array[$insert_array[0]]))
            $new_array[$insert_array[0]] = $insert_array[1];

        return $new_array;
    }

}