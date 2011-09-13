<?php

return array(
    'ilch_event' => array(
        'details' => array(
            'name' => __('Event Module'),
            'description' => '',
            'version' => Ilch::VERSION,
        ),
        'resources' => array(
            'download_server' => 'http://download.ilch.net/server/ilch_event/',
            'download_page' => 'http://download.ilch.net/modules/ilch_event/',
            'homepage' => 'https://github.com/samsoir/kohana-event',
            'documentation' => 'https://github.com/IlchCMS/Ilch-2/wiki/module-ilch_event',
            'support' => 'http://www.ilch.net/',
        ),
        'authors' => array(
            array(
                'name' => 'Sam de Freyssinet',
                'description' => '',
                'website' => 'http://def.reyssi.net',
                'email' => 'sam@def.reyssi.net',
                'company' => 'Adapter Pattern',
                'address' => '',
                'city' => 'London, UK',
                'zip_code' => '',
                'staate' => '',
            ),
        ),
        'required' => array(),
        'extends' => array()
    )
);