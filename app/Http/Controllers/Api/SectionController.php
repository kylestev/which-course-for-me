<?php namespace Courses\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

use Courses\Http\Controllers\Controller;
use Courses\Repositories\Section\CourseSectionRepositoryInterface;
use Courses\Transformers\SectionTransformer;

class SectionController extends Controller {

	use TraitTransformer;

	protected $sectionRepo;

	protected $response;

	protected $transformer;

	public function __construct(
		CourseSectionRepositoryInterface $sectionRepo,
		JsonResponse $response,
		SectionTransformer $transformer
	)
	{
		$this->sectionRepo = $sectionRepo;
		$this->response = $response;
		$this->transformer = $transformer;
	}

	public function index($subject_id, $course_id)
	{
		return $this->createJsonResponse(
			$this->sectionRepo->all($course_id)
		);
	}

	public function show($subject_id, $course_id, $section_id)
	{
		return $this->createJsonResponse(
			$this->sectionRepo->find($course_id, $section_id)
		);
	}

}
