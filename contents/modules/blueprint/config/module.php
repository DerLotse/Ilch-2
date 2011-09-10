<?php

return array(
    'blueprint' => array(
        'details' => array(
            'name' => __('Blueprint CSS Framework'),
            'description' => '',
            'version' => '1',
        ),
        'resources' => array(
            'download_server' => 'http://download.ilch.net/server/blueprint/',
            'download_page' => 'http://download.ilch.net/modules/blueprint/',
            'homepage' => 'http://www.blueprintcss.org/',
            'documentation' => 'https://github.com/joshuaclayton/blueprint-css/wiki',
            'support' => 'http://groups.google.com/group/blueprintcss',
        ),
        'authors' => array(
            array(
                'name' => 'Paul Jarvis',
                'website' => 'http://code.google.com/p/twotiny/',
            ),
            array(
                'name' => 'Komodo Media',
                'website' => 'http://www.christianmontoya.net/',
            ),
            array(
                'name' => 'Florian Körner',
                'description' => '',
                'website' => 'florian-koerner.eu',
                'email' => 'support@florian-koerner.eu',
                'company' => 'Florian Körner Weblösungen',
                'address' => '',
                'city' => 'Bad Segeberg',
                'zip_code' => 23795,
                'staate' => __('Germany'),
            ),
        ),
        'required' => array('ilch_media'),
    )
);