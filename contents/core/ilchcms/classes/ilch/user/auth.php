<?php

defined('SYSPATH') or die('No direct access allowed.');

abstract class Ilch_User_Auth
{

    /**
     * Loads Session
     *
     * @return  void
     */
    public function __construct()
    {
        $this->_session = Session::instance();
    }

    public function logged_in($auto_login = FALSE)
    {
        // Login-Status from Session
        $logged_in = $this->_session->get('logged_in', FALSE);
        
        if ($logged_in === TRUE)
        {
            return TRUE;
        }        
        
        // Check Autologin
        if ($auto_login === FALSE)
        {
            return FALSE;
        }
        else
        {
            return $this->auto_login();
        }
    }

    public function login($name, $password, $remember = TRUE)
    {
        // Hash the password
        $password = $this->hash($password);

        // Nutzer beziehen
        $user = Model::factory('user')->get($name, $password);

        // Wenn kein Ergebnis abbrechen
        if (!$user)
        {
            return FALSE;
        }

        // Wenn alte Session vorhanden diese löschen
        if ($this->logged_in() === TRUE)
        {
            $this->logout();
        }

        // Token erstellen, wenn gefordert
        if ($remember === TRUE)
        {
            Model::factory('user_token')->create($user['id']);
        }

        // Weitere Sessionwerte beziehen und speichern
        $this->complete_login($user);

        // Sie wurden eingeloggt ;)
        return TRUE;
    }

    public function auto_login()
    {
        // Create new token Model
        $token_model = Model::factory('user_token');
        
        // Get Token data
        $token = $token_model->get();

        // Delete token
        $token_model->delete();

        if ($token AND $token->user_agent === sha1(Request::$user_agent))
        {
            $token_model->create($token->user_id);

            // Weitere Sessionwerte beziehen und speichern
            $this->complete_login($token->user_id);

            return TRUE;
        }

        return FALSE;
    }

    private function complete_login($user)
    {
        // Nutzer als eingeloggt markieren
        $this->_session->set('logged_in', TRUE);

        // Nutzerdaten speichern
        $this->_session->set('user', $user);

        // do domething else
    }

    public function logout($destroy = FALSE)
    {
        // delete token
        Model::factory('user_token')->delete();

        if ($destroy === FALSE)
        {
            // Remove Login-Status
            $this->_session->delete('logged_in');

            // Remove Userdata
            $this->_session->delete('user');

            // Remove something else
        }
        else
        {
            // Destroy the session completely
            $this->_session->destroy();
        }
    }

    /**
     * Perform a hmac hash, using the configured method.
     *
     * @param   string  string to hash
     * @return  string
     */
    public function hash($password)
    {
        return hash_hmac(Kohana::config('auth.hash_method'), $password, Kohana::config('auth.hash_key'));
    }

}