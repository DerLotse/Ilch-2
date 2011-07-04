<?php

defined('SYSPATH') or die('No direct script access.');

class Model_User extends Model
{
    function get($login, $password = NULL)
    {
        $db = DB::select()->from('users')->where('user_status', '=', 1)->where('user_login', '=', $login);
        
        // Wenn Passwort existiert
        if ($password != NULL) $db->where('user_password', '=', $password);
        
        return $db->execute()->current();
          
    }
}