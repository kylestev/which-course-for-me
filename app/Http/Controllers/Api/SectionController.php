<?php

namespace Courses\Http\Controllers\Api;

use Courses\Http\Controllers\Controller;
use Courses\Repositories\Section\SectionRepositoryInterface;
use Courses\Transformers\SectionTransformer;
use Illuminate\Http\JsonResponse;

class SectionController extends Controller
{

    use TraitTransformer;

    protected $sectionRepo;

    protected $response;

    protected $transformer;

    public function __construct(
        SectionRepositoryInterface $sectionRepo,
        JsonResponse $response,
        SectionTransformer $transformer
    ) {
        $this->sectionRepo = $sectionRepo;
        $this->response    = $response;
        $this->transformer = $transformer;
    }

    public function index($subject_id, $course_id)
    {
        return $this->createJsonResponse(
            $this->sectionRepo->all($course_id)->all()
        );
    }

    public function show($subject_id, $course_id, $section_id)
    {
        return $this->createJsonResponse(
            $this->sectionRepo->find($course_id, $section_id)
        );
    }

}
