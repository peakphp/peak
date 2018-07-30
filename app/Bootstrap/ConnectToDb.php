<?php

namespace App\Bootstrap;

use Peak\Bedrock\Application\Config;
use Peak\Providers\Laravel\Database;
use Psr\Container\ContainerInterface;

/**
 * Class ConnectToDb
 * @package App\Bootstrap
 */
class ConnectToDb
{
    public function __construct(Config $config, ContainerInterface $container)
    {
        $db = new Database($config->get('db'));
        $container->add($db, 'database');
    }
}
