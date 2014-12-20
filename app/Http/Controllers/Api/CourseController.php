<?php namespace Courses\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

use Courses\Http\Controllers\Controller;
use Courses\Repositories\Course\CourseRepositoryInterface;
use Courses\Transformers\CourseTransformer;

class CourseController extends Controller {

	use TraitTransformer;

	protected $courseRepo;

	protected $response;

	protected $transformer;

	public function __construct(
		CourseRepositoryInterface $courseRepo,
		JsonResponse $response,
		CourseTransformer $transformer
	)
	{
		$this->courseRepo = $courseRepo;
		$this->response = $response;
		$this->transformer = $transformer;
	}

	public function index($subject_id)
	{
		return $this->createJsonResponse($this->courseRepo->findBySubjectId($subject_id)->toArray());
	}

	public function show($subject_id, $course_id)
	{
		return $this->createJsonResponse($this->courseRepo->find($course_id));
	}

}
