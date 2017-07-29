<?php
/*
|--------------------------------------------------------------------------
| Cli Application configurations overload for development environment
|--------------------------------------------------------------------------
*/
return [
    'php' => [
        'display_errors'         => 1,
        'display_startup_errors' => 1,
        'date.timezone'          => 'America/Toronto',
    ],
    
    'cron' => [
        'processor_prefix' => 'php climber',
        'cmd_prefix' => 'cron'
    ]
];