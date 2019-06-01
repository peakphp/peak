<?php

declare(strict_types=1);

namespace Core\Service;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerService
{
    /**
     * @return Logger
     * @throws \Exception
     */
    public function create(): Logger
    {
        $logger = new Logger('AppLogger');
        $logger->pushHandler(new StreamHandler(LOG_PATH.'/error.log', Logger::WARNING));
        return $logger;
    }
}
