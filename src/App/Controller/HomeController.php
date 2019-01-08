<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController implements Handler
{
    /**
     * Handle the request and return a response.
     */
    public function handle(Request $request): Response
    {
        return new HtmlResponse('Hello! PHP '.phpversion(), 200);
    }
}
