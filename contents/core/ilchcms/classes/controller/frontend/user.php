<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_User extends Controller_Frontend
{

    /**
     * Shows the profile editing mask
     */
    public function action_index()
    {
        
    }
    
    /**
     * Shows the signup mask
     */
    public function action_signup()
    {
        
    }
    
    /**
     * Confirm the signup, signout and email edit action
     */
    public function action_confirm($type = NULL, $key = NULL)
    {
        print_r($type).' + '.print_r($key);
    }
    
    /**
     * Shows the login mask
     */
    public function action_login()
    {
        // Set Title
        $this->template->title = 'User :: Login';

        // If logged in - redirect to startpage
        if (User::auth()->logged_in() === TRUE)
        {
            Request::initial()->redirect();
        }

        // Open Validation for POST
        $post = Validation::factory($_POST);

        // Set rules
        $post->bind(':password', Arr::get($_POST, 'password'));
        $post->rule('username', 'not_empty');
        $post->rule('username', 'Controller_Frontend_User::login', array(':validation', ':field', ':value', ':password'));

        // If POST is valid
        if ($post->check())
        {
            // Redirect
            Request::initial()->redirect(Arr::get($_POST, 'redirect'));
        }
        else
        {
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

            // Call template
            $this->template->content = View::factory('frontend/user/login', array('errors' => $errors, 'data' => $data));
        }
    }

    /**
     * Log the user out
     */
    public function action_logout()
    {
        // Logout and redirect to startpage
        User::auth()->logout();
        Request::initial()->redirect();
    }

    /**
     * Check userdata input
     * 
     * @param object $validation
     * @param string $field
     * @param string $username
     * @param string $password 
     */
    public static function login($validation, $field, $username, $password)
    {
        // Check login data
        if (User::auth()->login($username, $password) === FALSE)
        {
            // Set error message key
            $validation->error($field, 'no_user');
        }
    }

}