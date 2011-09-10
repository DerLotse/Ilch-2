<?php

return array(
    'ilch_jquery' => array(
        'details' => array(
            'name' => __('jQuery Module'),
            'description' => __('jQuery Javascript Framework'),
            'version' => '1.6.2',
        ),
        'resources' => array(
            'download_server' => 'http://download.ilch.net/server/ilch_jquery/',
            'download_page' => 'http://download.ilch.net/modules/ilch_jquery/',
            'homepage' => 'http://jquery.com/',
            'documentation' => 'http://docs.jquery.com/',
            'support' => 'http://forum.jquery.com/',
        ),
        'authors' => array(
        	array(
                'name' => 'The jQuery Project',
                'description' => '',
                'website' => 'http://jquery.com/',
                'email' => '',
                'company' => '',
                'address' => '',
                'city' => '',
                'zip_code' => '',
                'staate' => '',
            ),
            array(
                'name' => 'Florian Körner',
                'description' => 'Adjustment to Ilch CMS',
                'website' => 'florian-koerner.eu',
                'email' => 'support@florian-koerner.eu',
                'company' => 'Florian Körner Weblösungen',
                'address' => '',
                'city' => 'Bad Segeberg',
                'zip_code' => 23795,
                'staate' => __('Germany'),
            ),
        ),
        'required' => array(),
        'extends' => array()
    )
);