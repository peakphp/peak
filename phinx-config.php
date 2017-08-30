<?php

/*
|--------------------------------------------------------------------------
| Default phinx migration config
|--------------------------------------------------------------------------
*/

use Peak\Bedrock\Application;
use Peak\Di\Container;
use Peak\Config\ConfigSoftLoader;
use Peak\Common\DotNotationCollection;

$config = new DotNotationCollection();
$config->dev = (new ConfigSoftLoader([
    __DIR__.'/config/database.dev.php'
]))->asArray();
$config->prod = (new ConfigSoftLoader([
    __DIR__.'/config/database.prod.php'
]))->asArray();

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