<?php
/**
 * Application configs
 */
return [

    // the is the base for all environment
    'all' => [

        'php' => [
            'display_errors'         => 0,
            'display_startup_errors' => 0,
            'date.timezone'          => 'America/New_York',
        ],
        'front' => [
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
            // alternative syntax
            // 'user/{id]:num | user/profile'
        ],
    ],

    // those environments settings will override settings
    // of base "all" settings if set
    'dev'      => [
        'php' => [
            'display_errors'         => 1,
            'display_startup_errors' => 1,
        ],
        'db' => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'example',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ],

    'testing'  => [
        'php' => [
            'display_errors'         => 1,
            'display_startup_errors' => 1,
        ],
    ],

    'staging'  => [
    ],

    'prod'    => [
        'php' => [
            'display_errors'         => 0,
            'display_startup_errors' => 0,
        ],
        'front' => [
            'default_controller'         => 'index',
            'error_controller'           => 'error',
        ],
        'db' => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'example',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ],
];