<?php

defined('SYSPATH') or die('No direct script access.');

class Ilch_User
{

    /**
     * @var string or integer for the user class version
     */
    public static $version = '0.0.1';

    
    public static function login($user_data = array())
    {
        $query = DB::select()->from('users');
        
        foreach($user_data AS $key => $value)
        {
            $query->where($key, '=', $value);
        }
        
        $result = $query->execute();
        
        if ($result->count() == 0 OR $result->count() > 1) return false;
        
        
        
        return true;
    }

}