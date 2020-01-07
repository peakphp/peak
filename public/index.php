<?php

namespace {

    use Peak\Backpack\Bedrock\HttpAppBuilder;
    use Peak\Http\Response\Emitter;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Zend\Diactoros\Response\HtmlResponse;
    use Zend\Diactoros\ServerRequestFactory;

    require '../vendor/autoload.php';

    $app = (new HttpAppBuilder())->build();
    $app
        // Register a route
        ->get('/hello/{name}', function (Request $request) {
            return new HtmlResponse('Hello '.$request->args->name, 200);
        })

        // Stack a 404 handler at the end of application stack
        ->stack(function (Request $request) {
            return new HtmlResponse('404 - Not Found!', 404);
        })

        // Run application stack with current server request
        ->run(ServerRequestFactory::fromGlobals(), new Emitter());
}
