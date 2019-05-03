<?php

declare(strict_types=1);

namespace Core\Service;

use Peak\Backpack\ConfigLoader;
use Peak\Config\Config;

class ConfigService
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