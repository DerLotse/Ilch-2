<?php

return array(
    'ilch_basic' => array(
        'details' => array(
            'name' => __('Basic Ilch Module/System'),
            'description' => '',
            'version' => '2.0',
        ),
        'resources' => array(
            'download_server' => 'http://download.ilch-pluto.net/server/ilch-basic/',
            'download_page' => 'http://download.ilch-pluto.net/modules/ilch-basic/',
            'homepage' => 'http://www.ilch.net/',
            'documentation' => 'https://github.com/IlchCMS/Ilch-2/wiki/ilch-basic-module',
            'support' => 'http://www.ilch.net/',
        ),
        'authors' => array(
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
        'dependencies' => array('ilch_media'),
        'extends' => array('core_kohana_modules_database', 'modules_welcome')
    )
);