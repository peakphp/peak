<?php

namespace App\Controller;

use Peak\Blueprint\Bedrock\Application;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Zend\Diactoros\Response\HtmlResponse;
use \Exception;

/**
 * Class ErrorController
 * @package App\Controller
 */
class ErrorController implements Handler
{
    /**
     * @var Application
     */
    private $errorApp;

    /**
     * @var Exception
     */
    private $exception;

    /**
     * ErrorController constructor.
     * @param Application $errorApp
     * @param null|Application $app
     */
    public function __construct(Application $errorApp, Exception $exception)
    {
        $this->errorApp = $errorApp;
        $this->exception = $exception;
    }

    /**
     * Handle the request and return a response.
     */
    public function handle(Request $request): Response
    {
        if ($this->errorApp->getKernel()->getEnv() === 'dev') {
            $msg = '<pre>Exception: '.print_r($this->exception->getMessage(), true).'</pre>';
        } else {
            $msg = 'Something broken ... :(';
        }

        return new HtmlResponse($msg, 500);

    }
}
