<?php

defined('SYSPATH') or die('No direct script access.');

class Model_User extends Model
{
    function get($name, $password = NULL)
    {
        $db = DB::select()->from('users')->where('name', '=', $name);
        
        // Wenn Passwort existiert
        if ($password != NULL) $db->where('password', '=', $password);
        
        return $db->execute()->current();
          
    }
}