<?php

namespace {

    use Core\Service\ConfigService;
    use Core\Http\Handler\HomeHandler;
    use Core\Http\Handler\NotFoundHandler;
    use Core\Http\Handler\ErrorHandler;
    use Peak\Backpack\AppBuilder;
    use Peak\Backpack\Bootstrap\PhpSettings;
    use Peak\Backpack\Bootstrap\Session;
    use Peak\Http\Response\Emitter;
    use Zend\Diactoros\ServerRequestFactory;

    require '../vendor/autoload.php';

    try {

        $config = (new ConfigService())->create();

        // create main application
        $app = (new AppBuilder())
            ->setEnv($config->get('env.ENV', 'production'))
            ->setProps($config)
            ->addToContainerAfterBuild()
            ->build();

        $app
            // bootstrap stuff
            ->bootstrap([
                PhpSettings::class,
                Session::class,
            ])
            // Register a home route
            ->get('/', HomeHandler::class)

            // Stack a 404 handler at the end of application stack
            ->stack(NotFoundHandler::class)

            // Run application stack with current server request
            ->run(ServerRequestFactory::fromGlobals(), new Emitter());

    } catch (\Exception $e) {

        // Create an error application
        $errorApp = (new AppBuilder())
            ->setEnv($config->get('env.ENV', 'production'))
            ->setProps([
                'app' => $app ?? null
            ])
            ->build();

        // Stack and run without a server request
        $errorApp
            ->stack(new ErrorHandler($errorApp, $e))
            ->runDry(new Emitter());
    }
}
