<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Backend_Config extends Controller_Backend
{

    public function action_create()
    {
        // Set Title
        $this->template->title = 'Config :: Create SQL-Statement';

        // Open Validation for POST
        $post = Validation::factory($_POST);

        // Set rules
        $post->rule('group_name', 'not_empty');
        $post->rule('config_key', 'not_empty');
        $post->rule('field_type', 'not_empty');
        $post->rule('config_value', 'not_empty');


        // If POST is valid
        if ($post->check())
        {
            $config_value = $this->get_serialize($_POST['config_value']);

            if (empty($_POST['field_options']) === TRUE)
            {
                $field_options = '';
            }
            else
            {
                $field_options = $this->get_serialize($_POST['field_options']);
            }


            $created = "INSERT INTO `ilchcms2x`.`ic1_config` "
                    . "(`group_name`, `config_key`, `category_name`, `config_description`, `field_type`, `config_value`, `field_options`) "
                    . "VALUES ("
                    . "'" . Arr::get($_POST, 'group_name') . "', "
                    . "'" . Arr::get($_POST, 'config_key') . "', "
                    . "'" . Arr::get($_POST, 'category_name') . "', "
                    . "'" . Arr::get($_POST, 'category_description') . "', "
                    . "'" . Arr::get($_POST, 'field_type') . "', "
                    . "'" . $config_value . "', "
                    . "'" . $field_options . "');";

            $errors = array();
            $data = $_POST;
        }
        else
        {
            $created = '';
            
            // No POST - no errors
            if (count($_POST) == 0)
            {
                $errors = array();
                $data = array();
            }
            else
            {
                // Get all errors and POST-Data
                $errors = array('errors' => $post->errors('validation'));
                $data = $_POST;
            }
        }

        // Call template
        $this->template->content = View::factory('backend/svn/config/create', array('errors' => $errors, 'data' => $data, 'created' => $created));
    }

    private function get_serialize($data)
    {
        $data_values = explode("\n", $data);

        foreach ($data_values AS $key => $value)
        {
            $val_array = explode('=>', $value);

            if (isset($val_array[1]) === TRUE)
            {
                $data_value[trim($val_array[0])] = trim($val_array[1]);
            }
            else
            {
                $data_value[$key] = $value;
            }
        }

        if (count($data_value) == 1 AND isset($data_value[0]) === TRUE)
        {
            return serialize($data_value[0]);
        }
        else
        {
            return serialize($data_value);
        }
    }

}
