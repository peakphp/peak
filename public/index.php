<?php
/**
 * Peak App Launcher
 */
include './../vendor/autoload.php';

/**
 * Usefull when app and library or outside of public route
 */
$path = substr(str_replace(array($_SERVER['DOCUMENT_ROOT'],basename(__DIR__)),'',str_replace('\\','/',__DIR__)), 0, -1);

/**
 * Session
 */
session_start();

/**
 * LAUNCH Application
 */
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
    echo $e->getMessage();
}