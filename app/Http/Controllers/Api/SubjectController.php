<?php namespace Courses\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

use Courses\Http\Controllers\Controller;
use Courses\Repositories\Subject\SubjectRepositoryInterface;
use Courses\Transformers\SubjectTransformer;

class SubjectController extends Controller {

	use TraitTransformer;

	protected $response;

	protected $subjectRepo;

	protected $transformer;

	public function __construct(SubjectRepositoryInterface $subjectRepo,
								JsonResponse $response,
								SubjectTransformer $transformer)
	{
		$this->response = $response;
		$this->subjectRepo = $subjectRepo;
		$this->transformer = $transformer;
	}

	public function index()
	{
		return $this->createJsonResponse($this->subjectRepo->paginateResults()->toArray());
	}

	public function show($subject_id)
	{
		return $this->createJsonResponse(
			$this->subjectRepo->find($subject_id)
		);
	}

}
