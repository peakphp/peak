<?php

return [
    //sqlite
    'crondb' => [
        'driver' => 'pdo_sqlite',
        'path' => __DIR__.'/../database/cron.sqlite'
    ],

    //mysql
    /*'crondb' => [
       'driver' => 'pdo_mysql',
       'host' => 'localhost',
       'dbname' => 'crondatabase',
       'user' => 'root',
       'password' => '',
   ],*/
];