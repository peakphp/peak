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

    /**
     * @param array $envConfig
     * @return array
     */
    public function mapDbEnvConfig(array $envConfig): array
    {
        return [
            'driver' => $envConfig['DB_DRIVER'],
            'host' => $envConfig['DB_HOST'],
            'port' => $envConfig['DB_PORT'],
            'database' => $envConfig['DB_DATABASE'],
            'username' => $envConfig['DB_USERNAME'],
            'password' => $envConfig['DB_PASSWORD'],
            'charset' => $envConfig['DB_CHARSET'],
            'collation' => $envConfig['DB_COLLATION'],
            'prefix' => $envConfig['DB_PREFIX'],
        ];
    }
}
