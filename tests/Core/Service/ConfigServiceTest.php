<?php

use \PHPUnit\Framework\TestCase;
use \Core\Service\ConfigService;
use \Peak\Blueprint\Config\Config;

class ConfigServiceTest extends TestCase
{
    public function testCreate()
    {
        $config = (new ConfigService())->create();
        $this->assertInstanceOf(Config::class, $config);
    }
}
