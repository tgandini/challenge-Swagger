<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Slim\Views\PhpRenderer;

return function (App $app) {

    $app->get('/docs', function ($request, $response) {
        $rutaTemplates=__DIR__.'\..\Templates';
        $renderer = new PhpRenderer($rutaTemplates);
        return $renderer->render($response, "swagger.html");
    });

    //endpoint para get openapi.yaml y popular la vista
    $app->get('/openapi', function ($request, $response) {
        $yaml =file_get_contents (__DIR__ . '\..\..\openapi.yaml', 'rb');
        $response->getBody()->write($yaml);
        return $response;
    });    

    $app->get(
        '/',
        \App\Actions\WelcomeAction::class
    );

    $app->group(
        '/v1',
        function (RouteCollectorProxy $group) {

            $group->group(
                '/products',
                function (RouteCollectorProxy $group) {

                    $group->get(
                        '',
                        \App\Actions\Products\ViewAllProductsAction::class
                    );

                    $group->get(
                        '/{id:[0-9]+}',
                        \App\Actions\Products\GetProductByIdAction::class
                    );

                    $group->get(
                        '/{slug:[0-9-a-zA-Z]+}',
                        \App\Actions\Products\GetProductBySlugAction::class
                    );

                    $group->post(
                        '/search',
                        \App\Actions\Products\SearchProductAction::class
                    );
                }
            );

            $group->post(
                '/createProduct',
                \App\Actions\Products\CreateProductAction::class
            );

            $group->put(
                '/updateProduct/{id:[0-9]+}',
                \App\Actions\Products\UpdateProductAction::class
            );

            $group->delete(
                '/deleteProduct/{id:[0-9]+}',
                \App\Actions\Products\DeleteProductAction::class
            );
        }
    );
};
