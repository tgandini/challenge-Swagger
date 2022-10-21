<?php

namespace App\Actions\Products;

use App\Actions\Action;
use App\Entities\Product;
use App\Entities\ProductRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class DeleteProductAction extends Action
{
    protected $productRepository;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        /**
         * @var ProductRepository
         */
        $this->productRepository = $this->entityManager
            ->getRepository(Product::class);
    }

    /**
     * @OA\Delete(
     *     path="/v1/deleteProduct/{id}",
     *     tags={"Operaciones de Escritura"},
     *     summary="Borrar un Producto",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id del Producto",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *    @OA\Response(
     *        response=200,
     *        description="Producto borrado exitosamente",
     *        @OA\JsonContent(
     *        type="text/plain",
     *         example="Product deleted succesfully"
     *         )
     *   ),
     *    @OA\Response(
     *        response="500",
     *        description="Error al borrar el producto",
     *      @OA\JsonContent(ref="#/components/schemas/Internal Server error"),
     *   ), 
     * ) 
     */
    public function __invoke(Request $request, Response $response, $id): Response
    {
        /**
         * Product domain
         * 
         * @var \App\Entities\Product
         */
        $this->productRepository->destroy($id);

        $response->getBody()->write("Product deleted succesfully");

        return $response;
    }
}
