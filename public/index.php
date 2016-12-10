<?php
/**
 * Peak Application Launcher
 */

include './../vendor/autoload.php';

session_start();

$path = relative_basepath(__DIR__);

try {

    $app = Peak\Application::create([
        'env'  => 'dev',
        'path' => [
            'public' => $path.'/public',
            'app'    => $path.'/app',
        ],
    ]);

    $app->run()->render();
}
catch(\Exception $e) {
    if(is_object($app)) {
        $app->front->errorDispatch($e)
                   ->render();
    }
    // else {
    //     echo $e->getMessage();
    // }
}