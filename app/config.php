<?php
/**
 * Application configs
 */
return [

    // the is the base for all environment
    'all' => [

        'php' => [
            'display_errors'         => 1,
            'display_startup_errors' => 1,
            'date.timezone'          => 'America/New_York',
        ],
        'front' => [
            'allow_internal_controllers' => 1,
            'default_controller'         => 'index',
            'error_controller'           => 'error',
        ],
        'view' => [
            'engine'    => 'Layouts',
            'useLayout' => 'default',
        ],
        'routes' => [ //custom routes ...
            [
                'route'      => 'user/{id}:num',
                'controller' => 'user',
                'action'     => 'profile'
            ],
        ],
    ],

    // those environments settings will override settings of base "all" settings if set
    'dev'      => [
        'db' => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'eample',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ],

    'testing'  => [],

    'staging'  => [],

    'prod'    => [
        'php' => [
            'display_errors'         => 0,
            'display_startup_errors' => 0,
        ],
         'front' => [
            'allow_internal_controllers' => 0,
            'default_controller'         => 'index',
            'error_controller'           => 'error',
        ],
    ],
];