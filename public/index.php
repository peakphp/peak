<?php

namespace {

    use Core\Service\ConfigService;
    use Core\Http\Handler\HomeHandler;
    use Core\Http\Handler\NotFoundHandler;
    use Core\Service\ErrorAppService;
    use Core\Service\LoggerService;
    use Peak\Backpack\Bedrock\HttpAppBuilder;
    use Peak\Backpack\Bootstrap\PhpSettings;
    use Peak\Backpack\Bootstrap\Session;
    use Peak\Bedrock\Kernel;
    use Peak\Blueprint\Config\Config;
    use Peak\Di\Container;
    use Peak\Http\Response\Emitter;
    use Zend\Diactoros\ServerRequestFactory;

    require '../vendor/autoload.php';

    try {

        $container = new Container();

        $config = (new ConfigService())->create();
        $logger = (new LoggerService())->create();

        $container->set($logger);

        $kernel = new Kernel($config->get('env.ENV', 'prod'), $container);

        // create main application
        $app = (new HttpAppBuilder())
            ->setKernel($kernel)
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

    } catch (\Exception $exception) {

        $env = 'prod';
        if ($config instanceof Config) {
            $env = $config->get('env.ENV', 'prod');
        }

        $logger = $logger ?? null;
        $app = $app ?? null;

        (new ErrorAppService())->run($env, $exception, $logger, ['app' => $app]);
    }
}
