<?php
/*
|--------------------------------------------------------------------------
| Database for Climber cron system
|--------------------------------------------------------------------------
*/
return [
    //sqlite
    'cron' => [
        'db' => [
            'driver' => 'pdo_sqlite',
            'path' => __DIR__.'/../database/cron.sqlite'
        ]
    ],

    //mysql
    /*'cron' => [
        'db' => [
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'dbname' => 'testcron',
            'user' => 'root',
            'password' => '',
        ]
    ],*/
];