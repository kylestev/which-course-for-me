<?php namespace Courses\Http\Controllers\Api;

use Courses\Http\Controllers\Controller;
use Courses\Repositories\Subject\SubjectRepositoryInterface;
use Courses\Transformers\SubjectTransformer;
use Illuminate\Http\JsonResponse;

class SubjectController extends Controller
{

    use TraitTransformer;

    protected $response;

    protected $subjectRepo;

    protected $transformer;

    public function __construct(SubjectRepositoryInterface $subjectRepo,
        JsonResponse $response,
        SubjectTransformer $transformer) {
        $this->response    = $response;
        $this->subjectRepo = $subjectRepo;
        $this->transformer = $transformer;
    }

    public function index()
    {
        return $this->createJsonResponse($this->subjectRepo->paginateResults()->all());
    }

    public function show($subject_id)
    {
        return $this->createJsonResponse(
            $this->subjectRepo->find($subject_id)
        );
    }

}
