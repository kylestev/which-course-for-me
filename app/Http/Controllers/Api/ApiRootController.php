<?php namespace Courses\Http\Controllers\Api;

use Illuminate\Contracts\Cache\Factory as CacheFactory;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Http\JsonResponse;

use Courses\Http\Controllers\Controller;

class ApiRootController extends Controller {

	protected $cache;

	public function __construct(CacheFactory $cache)
	{
		$this->cache = $cache;
	}

	private function getRoutes()
	{
		$content = [];

		$routes = array_where(self::$router->getRoutes(), function ($key, $route) {
			return (! str_is('frontend.*', $route->getName())) && str_is('*.show', $route->getName());
		});

		$routes = array_map(function ($route) {
			$parts = explode('.', $route->getName());
			$last_idx = sizeof($parts) - 1;
			$name = implode('_', array_slice($parts, 0, $last_idx)) . '_url';

			$uri = getenv('APP_URL') . '/';
			$uri .= str_replace('s}', '_id}', $route->uri());

			return ['name' => $name, 'uri' => $uri];
		}, $routes);

		foreach ($routes as $route) {
			$content[$route['name']] = $route['uri'];
		}

		return $content;
	}

	private function getCachedRoutes()
	{
		return $this->cache->remember('routes.transformed', 1, function () {
			return $this->getRoutes();
		});
	}

	public function index(ViewFactory $view, JsonResponse $response)
	{
		$content = $this->getCachedRoutes();
		return $this->createResponse($response, $content);
	}

	private function createResponse($response, $data)
	{
		$response->setData($data);
		$response->setJsonOptions(JSON_PRETTY_PRINT);

		return $response;
	}

}
