<?php

/*
|--------------------------------------------------------------------------
| Application launcher
|--------------------------------------------------------------------------
*/
include './../vendor/autoload.php';

$container = new \Peak\Di\Container;

try {

    $app = new \Peak\Bedrock\Application($container, [
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
    if ($container->has('Peak\Bedrock\Application\Kernel')) {
        $kernel = \Peak\Bedrock\Application::kernel();
        $kernel->front->errorDispatch($e);
        $kernel->render();
    } elseif (isEnv('dev')) {
        printHtmlExceptionTrace($e);
    }

    // log exception
    new \Peak\Common\ExceptionLogger($e, __DIR__.'/../logs/errors.log');
}