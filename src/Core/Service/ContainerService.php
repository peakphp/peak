<?php

declare(strict_types=1);

namespace Core\Service;

use Peak\Di\Container;

class ContainerService
{
    /**
     * @param array $config
     * @return Container
     */
    public function create(array $config): Container
    {
        $container = new Container();

        if (isset($config['singletons'])) {
            $container->bindSingletons($config['singletons']);
        }

        if (isset($config['prototypes'])) {
            $container->bindPrototypes($config['prototypes']);
        }

        return $container;
    }
}
