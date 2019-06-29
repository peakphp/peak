<?php

use \PHPUnit\Framework\TestCase;
use \Core\Service\ContainerService;

class ContainerServiceTest extends TestCase
{
    public function testCreate()
    {
        $container = (new ContainerService())->create([]);
        $this->assertInstanceOf(Psr\Container\ContainerInterface::class, $container);
    }
}
