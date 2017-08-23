<?php
/*
|--------------------------------------------------------------------------
| Cli application base configurations
|--------------------------------------------------------------------------
*/
return [
    // General php setting(s) overflow, in case you can't tweak directly your php.ini.
    'php' => [
        'display_errors'         => 1,
        'display_startup_errors' => 1,
        'date.timezone'          => 'America/New_York',
    ],
    
    // Cron specific settings.
    'cron' => [
        'processor_prefix' => 'php climber',
        'cmd_prefix' => 'cron'
    ],

    // Register your commands here (support Dependency Injection).
    'commands' => [
        \Cli\Commands\ExampleCommand::class
    ]
];