<?php

namespace App\Actions\Products;

use App\Actions\Action;
use App\Entities\Product;
use App\Entities\ProductRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SearchProductAction extends Action
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
     * @OA\Post(
     *     path="/v1/products/search",
     *     tags={"Operaciones de Lectura"},
     *     summary="Get Producto by custom Parameter",
     *    @OA\RequestBody(
     *        required=true,
     *        @OA\MediaType(
     *           mediaType="multipart/form-data",
     *          @OA\Schema(
     *             @OA\Property(
     *               property="name",
     *               description="Buscar por Nombre",
     *               type="string"),
     *             @OA\Property(
     *               property="slug",
     *               description="Buscar por Slug",
     *               type="string"),
     *            @OA\Property(
     *               property="description",
     *               description="Buscar por Descripción",
     *               type="string"),
     *           @OA\Property(
     *               property="price",
     *               description="Buscar por Precio",
     *               type="number"),
     *           @OA\Property(
     *               property="stock",
     *               description="Buscar por Stock",
     *               type="number"),
     *          @OA\Property(
     *              property="keywords",
     *              description="Buscar por Palabras Clave",
     *             type="string")
     *      )
     *    )
     *  ),
     *   @OA\Response(
     *        response=200,
     *        description="Producto encontrado",
     *        @OA\JsonContent(ref="#/components/schemas/ProductResponse"),
     *   ),
     *    @OA\Response(
     *        response="404",
     *        description="Producto no encontrado",
     *      @OA\JsonContent(ref="#/components/schemas/Internal Server error"),
     *   ), 
     * ) 
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $products = $this->productRepository->getByQuery($data);

        $response->getBody()->write(json_encode($products));

        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}
