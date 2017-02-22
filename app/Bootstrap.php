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

    protected $processes = [];

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