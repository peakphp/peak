<?php

declare(strict_types=1);

namespace Core\Http\Handler;

use Peak\Blueprint\Bedrock\Application;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Zend\Diactoros\Response\HtmlResponse;
use \Exception;

class ErrorHandler implements Handler
{
    /**
     * @var string
     */
    private $env;

    /**
     * @var Exception
     */
    private $exception;

    /**
     * Show the exception message no matter $env is
     * @var array<string>
     */
    private $explicitExceptions = [];

    /**
     * @var array<string,int>
     */
    private $exceptionsStatus = [];


    /**
     * ErrorHandler constructor.
     * @param Application $errorApp
     * @param Exception $exception
     */
    public function __construct(string $env, Exception $exception) {

        $this->env = $env;
        $this->exception = $exception;
    }

    /**
     * Handle the request and return a response.
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        $data = [
            'error' => 'Something broke ... :('
        ];

        $exceptionClass = get_class($this->exception);

        if ($this->env === 'dev') {
            $data = [
                'errorCode' => $this->exception->getCode(),
                'errorName' => $exceptionClass,
                'error' => print_r($this->exception->getMessage(), true)
            ];
        } elseif (in_array($exceptionClass, $this->explicitExceptions)) {
            $data = [
                'error' => print_r($this->exception->getMessage(), true)
            ];
        }

        $status = $this->exceptionsStatus[$exceptionClass] ?? 500;

        return new HtmlResponse($data['error'], $status);
    }
}
