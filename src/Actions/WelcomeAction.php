<?php

namespace App\Actions;

use App\Actions\Action;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use OpenApi\Attributes as OA;

/**
 * @OA\Info(
 *     title="My First API",
 *     version="0.1"
 * )
 */
//openapi tags

 
class OpenApi {}


final class WelcomeAction extends Action
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    /**
     * Returns welcome message
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request  RequestInterface
     * @param \Psr\Http\Message\ResponseInterface      $response ResponseInterface
     * 
     * @return \Psr\Http\Message\ResponseInterface
     */

     /**
     * @OA\Get(
     *     path="/",
     *     @OA\Response(
     *         response="200",
     *     ),
     *     tags={"Testeo de la API"},
     *     summary="HolaMundo",
     *     description="Endpoint de prueba para ver si la API está corriendo",
     * ) 
     */
    public function __invoke(Request $request, Response $response, $args = []): Response
    {
        $response->getBody()->write("Hola Mundo!!! Api de productos funcionando =)");

        return $response;
    }
}
