<?php

require '../vendor/autoload.php';

use Peak\Backpack\AppBuilder;
use Peak\Backpack\ConfigLoader;
use Peak\Http\Response\Emitter;
use Zend\Diactoros\ServerRequestFactory;

try {
    // create a cached configuration
    /** @var \Peak\Config\Config $config */
    $config = (new ConfigLoader())
        ->setCache(CACHE_PATH, 'app-config', 10)
        ->load([
            PROJECT_PATH.'/.env',
            CONFIG_PATH . '/app.yml',
        ]);

    // create main application
    /** @var \Peak\Bedrock\Application\Application $app */
    $app = (new AppBuilder())
        ->setEnv($config->ENV ?? 'production')
        ->setProps($config)
        ->build();

    // Add application instance to the container
    $app->getContainer()->set($app, 'MyApp');

    // Bootstrap stuff
    $app->bootstrap([
        \Peak\Backpack\Bootstrap\PhpSettings::class,
        \Peak\Backpack\Bootstrap\Session::class,
        \Peak\Backpack\Bootstrap\Routing::class,
    ]);

    // Register a route
    $app->get('/',\App\Controller\HomeController::class);

    // Stack a 404 handler at the end of app stack
    $app->stack(\App\Controller\NotFoundController::class);

    // Run app stack with current server request
    $app->run(ServerRequestFactory::fromGlobals(), new Emitter());

} catch(\Exception $e) {

    // Create an error application
    $errorApp = (new AppBuilder())
        ->setProps(new \Peak\Collection\PropertiesBag([
            'app' => $app ?? null
        ]))
        ->setEnv($config->ENV ?? 'production')
        ->build();

    // Stack and run without a server request
    $errorApp
        ->stack(new \App\Controller\ErrorController($errorApp, $e))
        ->runDry(new Emitter());
}

// Create a DebugBar with dev env
if (isset($app) && $app->getKernel()->getEnv() === 'dev') {
    $debugBar = new \Peak\DebugBar\DebugBar($app->getContainer());
    $debugBar
        ->addDefaultModules()
        ->addModule(new \Peak\Backpack\DebugBar\AppConfig\AppConfig($app))
        ->addModule(new \Peak\Backpack\DebugBar\AppContainer\AppContainer($app));
    echo $debugBar->render();
}
