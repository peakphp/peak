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
    public function envProd()
    {
    }
}