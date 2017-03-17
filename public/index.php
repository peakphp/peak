<?php

/*
|--------------------------------------------------------------------------
| Application launcher
|--------------------------------------------------------------------------
*/
include './../vendor/autoload.php';

try {

    $container = new \Peak\Di\Container;

    $app = new \Peak\Bedrock\Application($container, [
        'env'  => 'dev',
        'conf' => 'config.php',
        'path' => [
            'public' => __DIR__,
            'app'    => __DIR__.'/../app',
        ]
    ]);

    $app->run()->render();

} catch(\Exception $e) {

    $container = \Peak\Bedrock\Application::container();

    // if kernel is present, try to render error controller.
    // otherwise, if environment is "dev" we throw exception message
    if ($container->hasInstance('Peak\Bedrock\Application\Kernel')) {
        $kernel = \Peak\Bedrock\Application::kernel();
        $kernel->front->errorDispatch($e);
        $kernel->render();
    } elseif (isEnv('dev')) {
        if ($e instanceof \Peak\Exception) {
            $e->printDebugTrace();
        } else {
            echo $e->getMessage();
        }
    }

    // log exception
    new \Peak\Common\ExceptionLogger($e, __DIR__.'/../logs/errors.log');
}