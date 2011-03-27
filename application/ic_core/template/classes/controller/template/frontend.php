<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Frontend-Spezifische Dinge kommen später hier rein. (z.B. Menü-, Boxen-Ausgabe)
 */
class Controller_Template_Frontend extends Controller_Template_General {

    // Festlegen des Templates
    public $template = 'frontend/index';

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
