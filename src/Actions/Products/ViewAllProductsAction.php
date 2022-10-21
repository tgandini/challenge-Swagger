<?php

namespace App\Actions\Products;

use App\Actions\Action;
use App\Entities\Product;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class ViewAllProductsAction extends Action
{
    /**
     * Product repository
     *
     * @var \App\Entities\ProductRepository
     */
    protected $productRepository;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->productRepository = $this->entityManager
            ->getRepository(Product::class);
    }

    /**
     * Fetch all products and returns response
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request  RequestInterface
     * @param \Psr\Http\Message\ResponseInterface      $response ResponseInterface
     * 
     * @return \Psr\Http\Message\ResponseInterface
     */

    /**
     * @OA\Get(
     *     path="/v1/products",    
     *     tags={"Operaciones de Lectura"},
     *     summary="Get all Productos",
     *     responses={
     *        @OA\Response(
     *            response=200,
     *            description="Success al fetch de todos los productos",
     *           @OA\JsonContent(
     *             type="array",
     *            @OA\Items(ref="#/components/schemas/ProductResponse")
     *           )             
     *        ), 
     *      }
     * ) 
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $products = $this->productRepository->fetchAll();

        $response->getBody()->write(json_encode($products));

        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}
