<?php

namespace App\Actions;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;


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
     *         @OA\Tag(name="Testing", description="asdasdasd"),
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

abstract class Action
{
    protected $container;

    protected $view;

    protected $entityManager;

    protected $session;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->view = $this->container->get('view');
        $this->entityManager = $this->container->get(EntityManager::class);

        /**
         * Session management
         * 
         * @var Odan\Session\PhpSession $session 
         */
        $this->session = $this->container->get('session');
    }
}
