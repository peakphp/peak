<?php
/**
 * Peak Application Launcher
 */

include './../vendor/autoload.php';

session_name('myapp');
session_start();

try {

    $app = Peak\Application::create([
        'env'  => 'dev',
        'path' => [
            'public' => __DIR__,
            'app'    => __DIR__.'/../app',
        ],
    ]);

    $app->run()->render();
}
catch(\Exception $e) {

    if(isEnv('dev')) {
        if($e instanceof \Peak\Exception) {
            $e->printDebugTrace();
        }
        else {
            echo $e->getMessage();
        }
        die();
    }
    
    
    if(is_object($app) && is_object($app->front)) {
        $app->front->errorDispatch($e)
                   ->render();
    }
    else {
        // log error here?
    }
}