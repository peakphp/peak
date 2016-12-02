<?php

return [

    'all' => [

        'php' => [
            'display_errors'         => 1,
            'display_startup_errors' => 1,
            'date.timezone'          => 'America/New_York',
        ],
        'front' => [
            'allow_internal_controllers' => 1,
            'default_controller'         => 'page',
            'error_controller'           => 'error',
        ],
        'view' => [
            'engine'    => 'Layouts',
            'useLayout' => 'default',
        ],
        'router' => [
            'addregex' => [],
        ],
    ],

    'dev'     => [],
    'testing' => [],
    'stagin'  => [],
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