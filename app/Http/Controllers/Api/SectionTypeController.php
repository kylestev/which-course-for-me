<?php namespace Courses\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

use Courses\SectionType;
use Courses\Http\Controllers\Controller;
use Courses\Http\Requests\Request;
use Courses\Repositories\SectionType\SectionTypeRepositoryInterface;
use Courses\Transformers\SectionTypeTransformer;

class SectionTypeController extends ApiController {

	public function __construct(SectionTypeRepositoryInterface $sectionTypeRepo,
								JsonResponse $response,
								SectionTypeTransformer $transformer)
	{
		parent::__construct($sectionTypeRepo, $response, $transformer);
	}

}
