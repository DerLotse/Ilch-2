<?php

return array(
    'ilch_user' => array(
        'details' => array(
            'name' => __('User, Auth, Permission Module'),
            'description' => '',
            'version' => Ilch::VERSION,
        ),
        'resources' => array(
            'download_server' => 'http://download.ilch.net/server/ilch_user/',
            'download_page' => 'http://download.ilch.net/modules/ilch_user/',
            'homepage' => 'http://www.ilch.net/',
            'documentation' => 'https://github.com/IlchCMS/Ilch-2/wiki/module-ilch_user',
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
        'required' => array('kohana_database', 'ilch_controller'),
        'extends' => array()
    )
);