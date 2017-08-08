<?php
/*
|--------------------------------------------------------------------------
| Configuration laucher when running Climber cron system
|--------------------------------------------------------------------------
*/
return [
    'env' => '%env%',
    'conf' => [
        __DIR__.'/cli.php',
        __DIR__.'/cron.database.php'
    ]
];
