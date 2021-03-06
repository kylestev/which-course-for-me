<?php namespace Courses\Http\Controllers\Api;

use Courses\Http\Controllers\Controller;
use Courses\Repositories\SectionType\SectionTypeRepositoryInterface;
use Courses\Transformers\SectionTypeTransformer;
use Illuminate\Http\JsonResponse;

class SectionTypeController extends Controller
{

    use TraitTransformer;

    protected $sectionTypeRepo;

    protected $response;

    protected $transformer;

    public function __construct(
        SectionTypeRepositoryInterface $sectionTypeRepo,
        JsonResponse $response,
        SectionTypeTransformer $transformer
    ) {
        $this->sectionTypeRepo = $sectionTypeRepo;
        $this->response        = $response;
        $this->transformer     = $transformer;
    }

    public function index()
    {
        return $this->createJsonResponse(
            $this->sectionTypeRepo->paginateResults()->all()
        );
    }

    public function show($instructor_id)
    {
        return $this->createJsonResponse(
            $this->sectionTypeRepo->find($instructor_id)
        );
    }

}
