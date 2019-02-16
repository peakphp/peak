<?php

namespace {

    use App\ConfigFactory;
    use App\Http\Controller\HomeController;
    use App\Http\Controller\NotFoundController;
    use App\Http\Controller\ErrorController;
    use Peak\Backpack\AppBuilder;
    use Peak\Backpack\Bootstrap\PhpSettings;
    use Peak\Backpack\Bootstrap\Session;
    use Peak\Http\Response\Emitter;
    use Zend\Diactoros\ServerRequestFactory;

    require '../vendor/autoload.php';

    try {

        $config = (new ConfigFactory())->create();

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
            ->setProps(new \Peak\Collection\PropertiesBag([
                'app' => $app ?? null
            ]))
            ->setEnv($config->get('env.ENV', 'production'))
            ->build();

        // Stack and run without a server request
        $errorApp
            ->stack(new ErrorController($errorApp, $e))
            ->runDry(new Emitter());
    }
}
