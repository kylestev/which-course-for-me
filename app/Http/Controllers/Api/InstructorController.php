<?php namespace Courses\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

use Courses\Http\Controllers\Controller;
use Courses\Repositories\Instructor\InstructorRepositoryInterface;
use Courses\Transformers\InstructorTransformer;

class InstructorController extends Controller {

	use TraitTransformer;

	protected $instructorRepo;

	protected $response;

	protected $transformer;

	public function __construct(
		InstructorRepositoryInterface $instructorRepo,
		JsonResponse $response,
		InstructorTransformer $transformer
	)
	{
		$this->instructorRepo = $instructorRepo;
		$this->response = $response;
		$this->transformer = $transformer;
	}

	public function index()
	{
		return $this->createJsonResponse(
			$this->instructorRepo->paginateResults()->toArray()
		);
	}

	public function show($instructor_id)
	{
		return $this->createJsonResponse(
			$this->instructorRepo->find($instructor_id)
		);
	}

}
