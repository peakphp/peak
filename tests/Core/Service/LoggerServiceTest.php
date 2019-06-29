<?php

use \PHPUnit\Framework\TestCase;
use \Core\Service\LoggerService;
use \Monolog\Logger;

class LoggerServiceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCreate()
    {
        $logger = (new LoggerService())->create();
        $this->assertInstanceOf(Logger::class, $logger);
    }
}
