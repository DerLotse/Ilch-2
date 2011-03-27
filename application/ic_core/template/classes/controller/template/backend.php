<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Backend-Spezifische Dinge kommen später hier rein. (z.B. Adminrechte, Adminmenü,...)
 */
class Controller_Template_Backend extends Controller_Template_General {

    // Festlegen des Templates
    public $template = 'backend/index';

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
