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
    'climber_cmd_prefix' => 'php climber'
];