<?php

namespace App;

use Peak\Backpack\ConfigLoader;
use Peak\Config\Config;

class ConfigFactory
{
    /**
     * @return Config
     */
    public function create(): Config
    {
        $cacheId = 'app-config';
        $ttl = 60;

        return (new ConfigLoader())
            ->setCache(CACHE_PATH, $cacheId, $ttl)
            ->load([
                ['env' => getenv()],
                CONFIG_PATH . '/app.yml',
            ]);
    }
}