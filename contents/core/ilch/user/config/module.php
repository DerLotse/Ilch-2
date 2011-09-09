<?php

return array(
    'ilch_user' => array(
        'details' => array(
            'name' => __('Ilch Basic Module'),
            'description' => '',
            'version' => Ilch::VERSION,
        ),
        'resources' => array(
            'download_server' => 'http://download.ilch.net/server/ilch_basic/',
            'download_page' => 'http://download.ilch.net/modules/ilch_basic/',
            'homepage' => 'http://www.ilch.net/',
            'documentation' => 'https://github.com/IlchCMS/Ilch-2/wiki/module-ilch_basic',
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
        'required' => array('kohana_database', 'kohana_cache'),
        'extends' => array('kohana_database')
    )
);