<?php
/**
 * Peak App Launcher
 */

include './../vendor/autoload.php';

/**
 * Session
 */
session_start();

/**
 * Usefull when app and library or outside of public route
 */
$path = substr(str_replace(array($_SERVER['DOCUMENT_ROOT'],basename(dirname(__FILE__))),'',str_replace('\\','/',dirname(__FILE__))), 0, -1);

/**
 * OPTIONNAL CONSTANTS
 * Hint: This can be setted as well in .htaccess
 */
define('APPLICATION_ENV',  'development');

/**
 * REQUIRED CONSTANTS
 * Hint: *_ROOT constants reflect the RELATIVE path from the public folder root (the folder where this file is located)
 */
define('PUBLIC_ROOT', $path.'/public');
define('LIBRARY_ROOT', str_replace('demo','library',$path));
define('APPLICATION_ROOT', $path.'/app');
define('APPLICATION_CONFIG', 'app.ini');

/**
 * LANCH Application
 */
try {
    $app = Peak\Core::init(5);
    $app->run()->render();
}
catch(\Exception $e) {
    echo $e->getMessage();
    
}