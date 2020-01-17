<?php

namespace {

    use Peak\Backpack\Bedrock\HttpAppBuilder;
    use Peak\Bedrock\Http\Application;
    use Peak\Http\Response\Emitter;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Zend\Diactoros\Response\HtmlResponse;
    use Zend\Diactoros\ServerRequestFactory;

    require '../vendor/autoload.php';

    /** @var Application $app */
    $app = (new HttpAppBuilder())->build();

    $app
        // register routes
        ->get('/', function (Request $request) {
            return new HtmlResponse('App running!', 200);
        })
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
