<?php

defined('SYSPATH') or die('No direct script access.');

class Widget_Login extends Widget
{
    public static function get()
    {
        return View::factory('widget/login');
    }
}