<?php

namespace {

    use Peak\Database\Common\LaravelPhinxMigration;
    use Peak\Database\Laravel\LaravelConnectionManager;
    use Peak\Database\Laravel\LaravelDatabaseService;
    use Peak\Database\Phinx\PhinxConfigService;
    use Peak\Database\Phinx\PhinxEnvConfig;

    require __DIR__.'/vendor/autoload.php';

    $env = getenv();
    $config = [
        'driver' => $env['DB_DRIVER'],
        'host' => $env['DB_HOST'],
        'port' => $env['DB_PORT'],
        'database' => $env['DB_DATABASE'],
        'username' => $env['DB_USERNAME'],
        'password' => $env['DB_PASSWORD'],
        'charset' => $env['DB_CHARSET'],
        'collation' => $env['DB_COLLATION'],
        'prefix' => $env['DB_PREFIX'],
    ];

    try {
        $db = (new LaravelDatabaseService())->createConnection($config, 'devConnectionName');
        LaravelConnectionManager::setConnection($db, 'dev');

        return (new PhinxConfigService())
            ->create(
                __DIR__.'/db/migrations', // migration scripts path
                LaravelPhinxMigration::class, // migration base class
                'migrations',  // default migration table name
                'dev', // default env
                [
                    new PhinxEnvConfig('dev', [
                        'name' => $db->getDatabaseName(),
                        'connection' => $db->getPdo(),
                    ])
                ]
            );

    } catch(\Exception $e) {
        die($e->getMessage());
    }
}