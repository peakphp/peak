<?php
/**
 * Peak Application Launcher
 */

include './../vendor/autoload.php';

session_name('myapp');
session_start();

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
    
}
catch(\Exception $e) {

    $container = \Peak\Bedrock\Application::container();

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
    } else {
        // log error here?
    }
}