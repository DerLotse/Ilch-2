<?php

return array(
    'cache' => array(
        'details' => array(
            'name' => __('Cache Control System'),
            'description' => '',
            'version' => '1',
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
        'required' => array('ilch_controller', 'kohana_cache'),
    )
);