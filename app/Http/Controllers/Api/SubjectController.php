<?php namespace Courses\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

use Courses\Subject;
use Courses\Http\Controllers\Controller;
use Courses\Http\Requests\CreateSubjectRequest;
use Courses\Repositories\Subject\SubjectRepositoryInterface;
use Courses\Transformers\SubjectTransformer;

class SubjectController extends ApiController {

	public function __construct(SubjectRepositoryInterface $subjectRepo,
								JsonResponse $response,
								SubjectTransformer $transformer)
	{
		parent::__construct($subjectRepo, $response, $transformer);
	}

	public function store(CreateSubjectRequest $request)
	{
		$input = $request->only('subjcode', 'name');

		return Subject::create($input);
	}

	public function update($id)
	{
		$keys = ['subjcode', 'name'];

		$updates = array_where(\Input::only($keys), function ($key, $value) use ($keys)
		{
			return ! is_null($value) && in_array($key, $keys);
		});

		if (sizeof($updates) === 0)
		{
			throw new \Exception('No valid fields to update.');
		}

		$subject = Subject::findOrFail($id);
		foreach ($updates as $key => $value) {
			$subject->$key = $value;
		}

		if (! $subject->save())
		{
			// todo: handle error
		}

		return $subject;
	}

}
