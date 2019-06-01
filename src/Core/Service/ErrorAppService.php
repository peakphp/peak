<?php

declare(strict_types=1);

namespace Core\Service;

use Core\Http\Handler\ErrorHandler;
use Monolog\Logger;
use Peak\Backpack\Bedrock\HttpAppBuilder;
use Peak\Bedrock\Http\Application;
use Peak\Http\Response\Emitter;
use Exception;

class ErrorAppService
{
    /**
     * @param string $env
     * @param \Exception $e
     * @param Logger|null $logger
     * @param array $props
     * @throws \Exception
     */
    public function run(string $env, Exception $exception, ?Logger $logger, $props = [])
    {
        if (isset($logger)) {
            $this->logError($logger, $exception);
        }

        try {
            /** @var Application $errorApp */
            $errorApp = (new HttpAppBuilder())
                ->setProps($props)
                ->setEnv($env)
                ->build();

            // Stack and run without a server request
            $errorApp
                ->stack(new ErrorHandler($env, $exception))
                ->runDry(new Emitter());

        } catch (Exception $errAppException) {
            if (isset($logger)) {
                $this->logError($logger, $errAppException);
            }
            die(($env === 'dev') ? $errAppException->getMessage() : 'Something wrong happened!');
        }
    }

    /**
     * @param Logger $logger
     * @param Exception $exception
     */
    private function logError(Logger $logger, Exception $exception)
    {
        $logger->error($exception->getMessage(), [
            get_class($exception),
            $exception->getCode()
        ]);
    }
}
