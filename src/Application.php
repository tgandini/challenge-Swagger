<?php



namespace App;

use Dotenv\Dotenv;
use DI\ContainerBuilder;
use DI\Bridge\Slim\Bridge;
use Doctrine\ORM\EntityManager;
use App\Providers\DoctrineProvider;
use App\Providers\ViewProvider;
use Odan\Session\PhpSession;
use Psr\Container\ContainerInterface;
use Slim\App;

class OpenApi {}
class Application
{
/**
 * @OA\Info(
 *     title="Challenge Swagger",
 *     description="Challenge Swagger propuesto por Avalith, facilitado por Chris y resuelto por Tomás Gandini",
 *    @OA\Contact(
 *          email="tomas.gandini@avalith.net",
 *          name="Tomás Gandini",
 *         url="https://github.com/tgandini/"
 *    ),  
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Local Server"
 * ),
  * @OA\Server(
 *     url="http://localhost:8080",
 *     description="Local Server"
 * ), * @OA\Server(
 *     url="http://localhost:9000",
 *     description="Local Server"
 * ),

*   @OpenAPIdefinition(
*     tags={
*         @OA\Tag(name="Testing", description="Endpoint de prueba para ver si la API está corriendo", order=1),
*         @OA\Tag(name="Operaciones de Lectura", description="Endpoints referidos al retrieve de productos según diferentes criterios" , order=2),
*         @OA\Tag(name="Operaciones de Escritura", description="Endpoints referidos a la inserción, modificación y eliminación de productos", order=3),


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
 
    protected $container;

    protected $session;

    public App $application;

    public function __construct()
    {

        $config = Dotenv::createImmutable(
            APP_ROOT . DIRECTORY_SEPARATOR . '..'
        );

        $config->load();

        $builder = new ContainerBuilder();

        $this->container = $builder->build();

        $this->container->set('settings', $this->includeSettings());

        $this->container->set(
            SessionInterface::class,
            function (ContainerInterface $container) {
                $settings = $container->get('settings');
                $this->session = new PhpSession();
                $this->session->setOptions((array)$settings['session']);

                return $this->session;
            }
        );

        $this->container->set('session', $this->session);

        $this->container->set('view', ViewProvider::provide(null));

        $this->container->set(
            EntityManager::class,
            DoctrineProvider::provide($this->container)
        );

        $this->application = Bridge::create($this->container);
    }

    public function includeSettings(): array
    {
        $settings = include_once __DIR__ . '/config/settings.php';

        return $settings;
    }
}
