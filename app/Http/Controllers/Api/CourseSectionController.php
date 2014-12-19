<?php namespace Courses\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

use Courses\Http\Controllers\Controller;
use Courses\Repositories\Section\CourseSectionRepositoryInterface;
use Courses\Transformers\SectionTransformer;

class CourseSectionController extends ApiController {

	public function __construct(CourseSectionRepositoryInterface $sectionRepo,
								JsonResponse $response,
								SectionTransformer $transformer)
	{
		parent::__construct($sectionRepo, $response, $transformer);
	}

	protected function _index($courseId)
	{
		return $this->createJsonResponse(
			$this->repo->all($courseId)
		);
	}

	public function show()
	{
		return $this->createJsonResponse(
			$this->repo->find(func_get_args())
		);
	}

}
