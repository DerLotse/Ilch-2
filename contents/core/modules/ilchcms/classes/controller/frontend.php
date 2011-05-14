<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend extends Controller_Template_Frontend
{

    public function before()
    {
        // Run anything that need ot run before this.
        parent::before();
    }

    public function after()
    {
        // Run anything that needs to run after this.
        parent::after();
    }

}
