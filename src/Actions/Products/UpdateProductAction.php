<?php


namespace App\Actions\Products;

use App\Actions\Action;
use App\Entities\Product;
use App\Entities\ProductRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UpdateProductAction extends Action
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
     * @OA\Put(
     *    path="/v1/updateProduct/{id}",
     *    tags={"Operaciones de Escritura"},
     *    summary="Actualizar un Producto",
     *   @OA\Parameter(
     *       name="id",
     *       in="path",
     *       description="id del Producto",
     *       required=true,
     *       @OA\Schema(
     *          type="integer",
     *       )
     *   ),
     *  @OA\RequestBody(
     *        required=true,
     *       @OA\MediaType(
     *          mediaType="application/json",
     *         @OA\Schema(
     *            ref="#/components/schemas/ProductRequest"
     *         )
     *       )
     *  ), 
     *      @OA\Response(
     *        response=200,
     *        description="Producto Actualizado exitosamente",
     *        @OA\JsonContent(
     *        type="text/plain",
     *         example="Product update succesfully")
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
        $data = $request->getParsedBody();

        $this->productRepository->update($id, $data);

        $response->getBody()->write("Product update succesfully");

        return $response
            ->withHeader('Content-Type', 'text/plain');
    }
}
