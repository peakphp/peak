<?php

namespace Cli;

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
        \Peak\Bedrock\Application\Bootstrap\ConfigPHP::class,
        \Peak\Climber\Cron\RegisterCommands::class,
        \Peak\Climber\Bootstrap\ConfigCommands::class,
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
