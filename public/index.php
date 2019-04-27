<?php

namespace {

    use Core\Service\ConfigService;
    use Core\Http\Controller\HomeController;
    use Core\Http\Controller\NotFoundController;
    use Core\Http\Controller\ErrorController;
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
            ->get('/', HomeController::class)

            // Stack a 404 handler at the end of application stack
            ->stack(NotFoundController::class)

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
            ->stack(new ErrorController($errorApp, $e))
            ->runDry(new Emitter());
    }
}
