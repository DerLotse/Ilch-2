<?php

defined('SYSPATH') or die('No direct script access.');

class Ilch_User
{

    // User instances
    protected static $_instance;

    /**
     *
     * @return  User_Auth
     */
    public static function auth()
    {
        if (!isset(User::$_instance['auth']))
        {
            // Create a new instance
            User::$_instance['auth'] = new User_Auth();
        }

        return User::$_instance['auth'];
    }
    
    /**
     *
     * @return  User_Permission
     */
    public static function permission()
    {
        if (!isset(User::$_instance['permission']))
        {
            // Create a new instance
            User::$_instance['permission'] = new User_Permission();
        }

        return User::$_instance['permission'];
    }

}