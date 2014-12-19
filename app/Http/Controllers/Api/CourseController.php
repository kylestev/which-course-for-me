<?php namespace Courses\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

use Courses\Course;
use Courses\Subject;
use Courses\Http\Controllers\Controller;
use Courses\Http\Requests\Request;
use Courses\Http\Requests\CreateCourseRequest;
use Courses\Repositories\Course\CourseRepositoryInterface;
use Courses\Transformers\CourseTransformer;

class CourseController extends ApiController {

	public function __construct(
		CourseRepositoryInterface $courseRepo,
		JsonResponse $response,
		CourseTransformer $transformer
	)
	{
		parent::__construct($courseRepo, $response, $transformer);
	}

}
