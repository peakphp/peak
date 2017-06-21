<?php
/*
|--------------------------------------------------------------------------
| Application configurations overload for development environment
|--------------------------------------------------------------------------
*/
return [
    'php' => [
        'display_errors'         => 1,
        'display_startup_errors' => 1
    ],
    'db' => [
        'driver'    => 'mysql',
        'host'      => '127.0.0.1',
        'database'  => 'peak',
        'username'  => 'root',
        'password'  => '',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ],
];