<?php namespace Courses\Http\Controllers\Api;

use Courses\Http\Controllers\Controller;
use Illuminate\Contracts\Cache\Factory as CacheFactory;
use Illuminate\Http\JsonResponse;

class ApiRootController extends Controller
{

    use TraitTransformer;

    protected $cache;

    public function __construct(
        CacheFactory $cache,
        JsonResponse $response
    ) {
        $this->cache       = $cache;
        $this->response    = $response;
        $this->transformer = null;
    }

    private function getRoutes()
    {
        $content = [];

        $routes = collect(self::$router->getRoutes()->getRoutes())->filter(function ($route) {
            return !str_is('frontend.*', $route->getName()) && str_is('*.show', $route->getName());
        })->map(function ($route) {
            $parts = explode('.', $route->getName());
            $last_idx = sizeof($parts) - 1;
            $name = implode('_', array_slice($parts, 0, $last_idx)) . '_url';

            $uri = getenv('API_URL') . '/';
            $uri .= str_replace('s}', '_id}', $route->uri());

            return ['name' => $name, 'uri' => $uri];
        });

        foreach ($routes as $route) {
            $content[$route['name']] = $route['uri'];
        }

        return $content;
    }

    private function getCachedRoutes()
    {
        return $this->cache->remember('api.routes', 1, function () {
            return $this->getRoutes();
        });
    }

    public function index()
    {
        $content = $this->getCachedRoutes();
        return $this->createJsonResponse($content);
    }

}
