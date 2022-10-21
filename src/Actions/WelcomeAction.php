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


class OpenApi {}
    /**
     * @OpenAPIdefinition(
     *     tags={
     *         @OA\Tag(name="Testing", description="Endpoint de prueba para ver si la API está corriendo", order=1),
     *         @OA\Tag(name="Operaciones de Lectura", description="Todo lo referido al retrieve de productos según diferentes criterios" , order=2),
     *         @OA\Tag(name="Operaciones de Escritura", description="Todo lo referido a la inserción, modificación y eliminación de productos", order=3),
     */

    /**
     * @OA\Schema(
     *     schema="ProductRequest",
     *     type="object",
     *     title="ProductRequest",
     *     @OA\Property(property="name", type="string", required={"true"}),
     *     @OA\Property(property="slug", type="string"),
     *     @OA\Property(property="description", type="string"),
     *     @OA\Property(property="price", type="number"),
     *     @OA\Property(property="stock", type="integer"),
     *     @OA\Property(property="keywords", type="string"),
     * )
     * @OA\Schema(
     *     schema="ProductResponse",
     *     type="object",
     *     title="ProductResponse",
     *     @OA\Property(property="id", type="integer"),
     *     @OA\Property(property="name", type="string"),
     *     @OA\Property(property="slug", type="string"),
     *     @OA\Property(property="description", type="string"),
     *     @OA\Property(property="price", type="integer"),
     *     @OA\Property(property="stock", type="number"),
     *     @OA\Property(property="keywords", type="string"),
     * )
     * @OA\Schema(
     *      schema="Exception",
     *      type="object",
     *      title="Exception",
     *      @OA\Property(property="type", type="string"),
     *      @OA\Property(property="code", type="integer"),
     *      @OA\Property(property="message", type="string"),
     *      @OA\Property(property="file", type="string"),
     *      @OA\Property(property="line", type="integer"),
     * )
     * @OA\Schema(
     *     schema="Internal Server error",
     *     type="object",
     *     title="Internal Server error al hacer requests fallidos",
     *    @OA\Property(property="message", type="string"),
     *    @OA\Property(property="exception", type="object", ref="#/components/schemas/Exception"),
     * )
     */

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
     *     tags={"Testing"},
     *     summary="HolaMundo de prueba",
     * ) 
     */
    public function __invoke(Request $request, Response $response, $args = []): Response
    {
        $response->getBody()->write("Welcome to Products API");
        return $response;
    }
}
