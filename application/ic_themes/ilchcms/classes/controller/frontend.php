<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Sollten Themes besondere Funktionen haben, werden diese hier definiert. Sonst passiert einfach nichts.
 */
class Controller_Frontend extends Controller_Template_Frontend {
    public $template = 'frontend/index';

    public function before()
    {
        // Run anything that need ot run before this.
        parent::before();
    }
}