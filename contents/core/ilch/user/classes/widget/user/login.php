<?php defined('SYSPATH') or die('No direct script access.');

class Widget_User_Login extends Widget {
    
    public static function get()
    {
        $logged_in = User::auth()->logged_in();
        return View::factory('widget/user/login', array('logged_in' => $logged_in));
    }
    
}