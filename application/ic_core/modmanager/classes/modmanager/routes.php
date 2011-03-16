<?php

defined('SYSPATH') or die('No direct script access.');

class Modmanager_Routes
{

    /**
     * @todo Datenbankbasierend
     */
    public static function index($uri)
    {
        // Wenn Backend
        if (preg_match('#^backend(?:/(?P<controller>[^/.,;?\n]++)(?:/(?P<action>[^/.,;?\n]++)(?:/(?P<overflow>(.*?)))?)?)?$#uD', $uri, $match))
        {
            // Controller
            $controller = (isset($match[1]) === TRUE) ? $match[1] : 'welcome';

            // Action
            $action = (isset($match[2]) === TRUE) ? $match[2] : 'index';

            // Overflow
            $overflow = (isset($match[3]) === TRUE) ? explode('/', $match[3]) : array();

            return array(
                'directory' => 'backend/',
                'controller' => $controller,
                'action' => $action
            )+$overflow;
        }
        // Wenn Frontend
        else if (preg_match('#^(?:(?P<controller>[^/.,;?\n]++)(?:/(?P<action>[^/.,;?\n]++)(?:/(?P<overflow>(.*?)))?)?)?$#uD', $uri, $match))
        {
            // Controller
            $controller = (isset($match[1]) === TRUE) ? $match[1] : 'welcome';

            // Action
            $action = (isset($match[2]) === TRUE) ? $match[2] : 'index';

            // Overflow
            $overflow = (isset($match[3]) === TRUE) ? explode('/', $match[3]) : array();

            return array(
                'directory' => 'frontend/',
                'controller' => $controller,
                'action' => $action
            )+$overflow;
        }
    }

}