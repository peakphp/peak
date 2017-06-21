<?php
/*
|--------------------------------------------------------------------------
| Application base configurations
|--------------------------------------------------------------------------
*/
return [
    'php' => [
        'display_errors'         => 0,
        'display_startup_errors' => 0,
        'date.timezone'          => 'America/New_York',
    ],
    'front' => [
        'default_controller' => 'index',
        'error_controller'   => 'error',
    ],
    'view' => [
        'engine'    => 'Layouts',
        'useLayout' => 'default',
    ],
    'routes' => [ //custom route(s) ...
        //example:
        //'user/{id}:num | user/profile',
    ]
];