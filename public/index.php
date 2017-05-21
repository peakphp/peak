<?php

/*
|--------------------------------------------------------------------------
| Application launcher
|--------------------------------------------------------------------------
*/
include './../vendor/autoload.php';

use Peak\Bedrock\Application;
use Peak\Bedrock\Application\Kernel;
use Peak\Di\Container;
use Peak\Common\ExceptionLogger;

$container = new Container;

try {
    $app = new Application($container, [
        'env'  => detectEnvFile(__DIR__),
        'conf' => 'config.php',
        'path' => [
            'public' => __DIR__,
            'app'    => __DIR__.'/../app',
        ]
    ]);

    $app->run()->render();

} catch(\Exception $e) {

    // if kernel is present, try to render error controller.
    // otherwise, if environment is "dev" we throw exception message
    if ($container->has('Kernel')) {
        $kernel = Application::kernel();
        $kernel->front->errorDispatch($e);
        $kernel->render();
    } elseif (isEnv('dev')) {
        printHtmlExceptionTrace($e);
    }

    // log exception
    new ExceptionLogger($e, __DIR__.'/../logs/errors.log');
}