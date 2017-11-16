<?php

namespace App;

use Peak\Bedrock\Application\Bootstrapper;

/**
 * App Bootstrapper
 */
class Bootstrap extends Bootstrapper
{
    /**
     * App process
     * @var array
     */
    protected $processes = [
        \Peak\Bedrock\Application\Bootstrap\Session::class,
        \Peak\Bedrock\Application\Bootstrap\ConfigPHP::class,
        \Peak\Bedrock\Application\Bootstrap\ConfigView::class,
        \Peak\Bedrock\Application\Bootstrap\ConfigCustomRoutes::class,
        //\App\Bootstrap\ConnectToDb::class
    ];

    /**
     * Development env
     */
    public function envDev()
    {
    }

    /**
     * Production env
     */
    public function envProd()
    {
    }
}
