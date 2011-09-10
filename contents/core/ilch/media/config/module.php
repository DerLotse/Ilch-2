<?php

return array(
    'ilch_media' => array(
        'details' => array(
            'name' => __('Ilch Media System'),
            'description' => __('Can load and display media files'),
            'version' => Ilch::VERSION,
        ),
        'resources' => array(
            'download_server' => 'http://download.ilch.net/server/ilch_media/',
            'download_page' => 'http://download.ilch.net/modules/ilch_media/',
            'homepage' => 'http://www.ilch.net/',
            'documentation' => 'https://github.com/IlchCMS/Ilch-2/wiki/module-ilch_media',
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
        'required' => array(),
        'extends' => array()
    )
);