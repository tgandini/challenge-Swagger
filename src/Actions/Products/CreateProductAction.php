<?php


namespace App\Actions\Products;

use App\Actions\Action;
use App\Entities\Product;
use App\Entities\ProductRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CreateProductAction extends Action
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
     *     path="/v1/createProduct",
     *     tags={"Operaciones de Escritura"},
     *     summary="Dar de alta un Producto",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     description="Nombre del producto",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="slug",
     *                     description="Slug del producto",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     description="Descripción del producto",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="price",
     *                     description="Precio del producto",
     *                     type="number"
     *                 ),
     *                 @OA\Property(
     *                     property="stock",
     *                     description="Stock del producto",
     *                     type="number"
     *                 ),
     *                 @OA\Property(
     *                     property="keywords",
     *                     description="Palabras clave (Keywords) del producto",
     *                     type="string"
     *                 ),
     *                 required={"name", "slug", "description", "price", "stock", "keywords"}
     *             )
     *         )
     *     ),
     *    @OA\Response(
     *        response=200,
     *       description="Success al crear un producto",
     *      @OA\JsonContent(
     *       type="text/plain",
     *     example="Product created succesfully"
     *     )
     *   ),
     *  @OA\Response(
     *     response="500",
     *    description="Internal Server error al crear un producto",
     *  @OA\JsonContent(
     *    type="array",
     *   ref="#/components/schemas/Internal Server error Alta"
     *   )
     * )
     * )
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $this->productRepository->create($data);

        $response->getBody()->write("Product created succesfully");

        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}
