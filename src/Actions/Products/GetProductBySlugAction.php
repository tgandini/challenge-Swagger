<?php

namespace App\Actions\Products;

use App\Actions\Action;
use App\Entities\Product;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetProductBySlugAction extends Action
{
    protected $productRepository;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        /**
         * @var \App\Entities\ProductRepository
         */
        $this->productRepository = $this->entityManager
            ->getRepository(Product::class);
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
     *    path="/v1/products/{slug}",
     *   @OA\Response(
     *      response="200",
     *     description="Búsqueda exitosa",
     *    @OA\JsonContent(ref="#/components/schemas/Product"),
     *   ),
     * @OA\Response(
     *    response="500",
     *  description="Error al buscar el producto",
     * @OA\JsonContent(ref="#/components/schemas/Internal Server error"),
     * ),
     *   tags={"Operaciones de Lectura"},
     * summary="Get producto by slug",
     * @OA\Parameter(
     *   name="slug",
     * in="path",
     * description="slug del Producto",
     * required=true,
     * @OA\Schema(
     *  type="string",
     *  ),
     * ),
     * )
     */
    public function __invoke(Request $request, Response $response, $slug): Response
    {
        /**
         * Product domain
         * 
         * @var \App\Entities\Product
         */
        $product = $this->productRepository->getBySlug($slug);

        $response->getBody()->write($product->toJSON());

        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}
