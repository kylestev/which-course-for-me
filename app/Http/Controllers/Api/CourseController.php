<?php namespace Courses\Http\Controllers\Api;

use Courses\Http\Controllers\Controller;
use Courses\Repositories\Course\CourseRepositoryInterface;
use Courses\Transformers\CourseTransformer;
use Illuminate\Http\JsonResponse;

class CourseController extends Controller
{

    use TraitTransformer;

    protected $courseRepo;

    protected $response;

    protected $transformer;

    public function __construct(
        CourseRepositoryInterface $courseRepo,
        JsonResponse $response,
        CourseTransformer $transformer
    ) {
        $this->courseRepo  = $courseRepo;
        $this->response    = $response;
        $this->transformer = $transformer;
    }

    public function index($subject_id)
    {
        return $this->createJsonResponse($this->courseRepo->findBySubjectId($subject_id)->get()->all());
    }

    public function show($subject_id, $course_id)
    {
        return $this->createJsonResponse($this->courseRepo->find($course_id));
    }

}
