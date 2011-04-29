<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_User_Login extends Controller_Frontend
{

    public function action_index()
    {

        // When ther is a POST
        if ($_POST)
        {
            $validation = Validation::factory($_POST);

            $validation->rule(Kohana::config('user.login_method'), 'not_empty')
                    ->rule('password', 'not_empty');

            if ($validation->check() === TRUE)
            {
                
            }
            else
            {
                $errors = $validation->errors('login');
                $values = $validation;
            }
        }
        else
        {
            $errors = array();
            $values = array();
        }


        // Set Title
        $this->template->title = __('Sign in');

        // Set data
        $data = array(
            'login_method' => Kohana::config('user.login_method'),
            'errors' => $errors,
            'values' => $values
        );

        // Load a template
        $this->template->content = View::factory('frontend/user/login', $data);
    }

}