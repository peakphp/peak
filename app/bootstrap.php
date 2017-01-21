<?php
namespace App;

use Peak\Application;
use Peak\Application\Bootstrapper;
use Peak\Registry;

/**
 * App Bootstrapper
 */
class Bootstrap extends Bootstrapper
{

    /**
     * Connect to database
     */
    public function initDb()
    {
        // $db = new Peak\Database(Application::conf('db'));
        // Registry::set('db', $db);
    }

    /**
     * Development env
     */
    public function envDev()
    {
    }

    /**
     * Production env
     */
    public function devProd()
    {
    }

}