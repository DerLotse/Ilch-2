<?php

defined('SYSPATH') or die('No direct script access.');

class Model_News extends Model
{
    function get()
    {
        //$db = DB::select()->from('users')->where('user_status', '=', 1)->where('user_login', '=', $login);
        
        // Wenn Passwort existiert
        //if ($password != NULL) $db->where('user_password', '=', $password);
        
        //return $db->execute()->current();
		return true;
    }
}