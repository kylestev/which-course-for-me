<?php namespace Courses\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

use Courses\Instructor;
use Courses\Http\Controllers\Controller;
use Courses\Http\Requests\CreateInstructorRequest;
use Courses\Repositories\Instructor\InstructorRepositoryInterface;
use Courses\Transformers\InstructorTransformer;

class InstructorController extends ApiController {

	public function __construct(InstructorRepositoryInterface $instructorRepo,
								JsonResponse $response,
								InstructorTransformer $transformer)
	{
		parent::__construct($instructorRepo, $response, $transformer);
	}

	public function store(CreateInstructorRequest $request)
	{
		$input = $request->only('name', 'email');

		return Instructor::create($input);
	}

}
