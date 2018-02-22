<?php
/*
|--------------------------------------------------------------------------
| Application base configurations
|--------------------------------------------------------------------------
*/
return [

    // Generic informations
    'name' => 'PeakApp',
    'version' => '1.0',

    // General php setting(s) overflow, in case you can't tweak directly your php.ini.
    'php' => [
        'display_errors'         => 0,
        'display_startup_errors' => 0,
        'date.timezone'          => 'America/New_York',
    ],

    // Session configuration for Peak\Bedrock\Application\Bootstrap\Session
    'session' => [
        //'name' => '',
        //'save_path' => '',
        //'save_handler' => '',
        'options' => [
            'cookie_httponly' => true,
            'cookie_secure' => true,
        ]
    ],

    // Define default workflow of the front.
    'front' => [
        'default_controller' => 'index',
        'error_controller'   => 'error',
    ],

    // Prepare the view engine and the layout.
    'view' => [
        'engine'    => 'Layouts',
        'useLayout' => 'default',
    ],

    // Let the routing system guess route based on the request uri.
    'auto_routing' => 0,

    // Define custom route(s).
    // When "auto_routing" is disabled, only defined route(s) below will be resolved.
    // Regardless of "auto_routing" value, if the request uri is empty, the front 
    // "default_controller" will be use
    'routes' => [
        // example:
        //'user/{id}:num | user/profile',
    ]
];