<?php

namespace {

    use App\Controller\HomeController;
    use App\Controller\NotFoundController;
    use Peak\Backpack\AppBuilder;
    use Peak\Backpack\Bootstrap\Routing;
    use Peak\Backpack\Bootstrap\Session;
    use Peak\Backpack\ConfigLoader;
    use Peak\Http\Response\Emitter;
    use Zend\Diactoros\ServerRequestFactory;

    require '../vendor/autoload.php';

    try {
        // create a cached configuration
        $config = (new ConfigLoader())
            ->setCache(CACHE_PATH, 'app-config', 60)
            ->load([
                ['env' => getenv()],
                CONFIG_PATH . '/app.yml',
            ]);

        // create main application
        /** @var \Peak\Bedrock\Application\Application $app */
        $app = (new AppBuilder())
            ->setEnv($config->get('env.ENV', 'production'))
            ->setProps($config)
            ->addToContainerAfterBuild()
            ->build();

        $app
            // bootstrap stuff
            ->bootstrap([
                Session::class,
                Routing::class,
            ])
            // Register a home route
            ->get('/', HomeController::class)

            // Stack a 404 handler at the end of application stack
            ->stack(NotFoundController::class)

            // Run application stack with current server request
            ->run(ServerRequestFactory::fromGlobals(), new Emitter());

    } catch (\Exception $e) {

        echo $e->getMessage();
        // Create an error application
        $errorApp = (new AppBuilder())
            ->setProps(new \Peak\Collection\PropertiesBag([
                'app' => $app ?? null
            ]))
            ->setEnv($config->get('env.ENV', 'production'))
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
}