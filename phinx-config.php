<?php

/*
|--------------------------------------------------------------------------
| Default phinx migration config
|--------------------------------------------------------------------------
*/

use Peak\Bedrock\Application;
use Peak\Config\File;
use Peak\Di\Container;

$config = new \Peak\Config\File(__DIR__.'/app/config.php');
Application::setContainer(new Container);
Application::container()->add($config, 'Config');

define('PHINX_ENV', getPhinxMigrateEnv());

return [
    'paths' => [
        'migrations' => 'database/migrations'
    ],
    'migration_base_class' => '\App\Models\Migration',
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'dev',
        'dev' => [
            'adapter' => $config->get('dev.db.driver'),
            'host'    => $config->get('dev.db.host'),
            'name'    => $config->get('dev.db.database'),
            'user'    => $config->get('dev.db.username'),
            'pass'    => $config->get('dev.db.password'),
            'port'    => $config->get('dev.db.port')
        ],
        'prod' => [
            'adapter' => $config->get('prod.db.driver'),
            'host'    => $config->get('prod.db.host'),
            'name'    => $config->get('prod.db.database'),
            'user'    => $config->get('prod.db.username'),
            'pass'    => $config->get('prod.db.password'),
            'port'    => $config->get('prod.db.port')
        ],
    ]
];