<?php
namespace App;

use Peak\Application;
use Peak\Application\Bootstrapper;

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
        //Database::connect(Application::conf('db'));
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