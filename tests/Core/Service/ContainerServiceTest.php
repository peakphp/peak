<?php

use \PHPUnit\Framework\TestCase;
use \Core\Service\ContainerService;
use \Psr\Container\ContainerInterface;

class ContainerServiceTest extends TestCase
{
    public function testCreate()
    {
        $container = (new ContainerService())->create([]);
        $this->assertInstanceOf(ContainerInterface::class, $container);
    }
}
