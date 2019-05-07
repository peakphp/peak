<?php

declare(strict_types=1);

namespace Core\Http\Handler;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Zend\Diactoros\Response\HtmlResponse;

class HomeHandler implements Handler
{
    /**
     * Handle the request and return a response.
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        return new HtmlResponse('Hello! PHP '.phpversion(), 200);
    }
}
