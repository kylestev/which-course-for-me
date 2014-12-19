<?php namespace Courses\Http\Controllers\Api;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;

use Courses\Http\Controllers\Controller;
use Courses\Http\Requests\Request;
use Courses\Repositories\RepositoryInterface;
use Courses\Transformers\Transformer;

abstract class ApiController extends Controller {

	/**
	 * @var RepositoryInterface
	 **/
	protected $repo;

	/**
	 * @var JsonResponse
	 **/
	protected $response;

	/**
	 * @var Transformer
	 **/
	protected $transformer;

	/**
	 * Display the specified resource.
	 *
	 * @param  RepositoryInterface $repo used to interface with datastores
	 * @param  JsonResponse $response
	 * @param  Transformer $transform used when transforming objects returned
	 *			by this controller.
	 * @return Response
	 */
	public function __construct(RepositoryInterface $repo,
								JsonResponse $response,
								Transformer $transformer = null)
	{
		$this->repo = $repo;
		$this->response = $response;
		$this->transformer = $transformer;
	}

	protected function _index($args)
	{
		return $this->createJsonResponse(
			$this->repo->all()
		);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  int  $nestedId used for nested route resources
	 * @return JsonResponse
	 */
	public function index()
	{
		return $this->_index(func_get_args());
	}

	protected function _show()
	{
		$args = func_get_args();
		return $this->createJsonResponse(
			$this->repo->find($args[0])
		);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id - primary key for the route resource
	 * @param  int  $nestedId - used for nested route resources
	 * @return Response
	 */
	public function show()
	{
		return $this->_show(func_get_args());
	}

	/**
	 * Light wrapper around a null check against this instance's transformer
	 * attribute to see if it has been set.
	 *
	 * @return boolean
	 */
	protected function validTransformer()
	{
		return ! is_null($this->transformer);
	}

	protected function transformData($data)
	{
		if (array_key_exists('data', $data))
		{
			return array_set($data, 'data', $this->transformer->transform(array_get($data, 'data')));
		}
		else
		{
			return [ 'data' => $this->transformer->transform($data) ];
		}
	}

	/**
	 * Used to create a pretty-printed JSON Response object with the provided
	 * data.
	 *
	 * @param  array $data either an associative array describing a single
	 *			item, or an array of items.
	 * @return Response
	 **/
	protected function createJsonResponse($data)
	{
		if ($this->validTransformer())
		{
			$data = $this->transformData($data);
		}

		$this->response->setData($data);
		$this->response->setJsonOptions(JSON_PRETTY_PRINT);

		return $this->response;
	}

}
