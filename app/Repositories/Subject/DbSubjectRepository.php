<?php namespace Courses\Repositories\Subject;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Courses\Subject;
use Courses\Exceptions\NotFoundException;

class DbSubjectRepository implements SubjectRepositoryInterface {

	public function find($id)
	{
		try {
			return Subject::findOrFail($id)->toArray();
		} catch (ModelNotFoundException $e) {
			throw new NotFoundException('Subject not found');
		}
	}

	public function paginateResults()
	{
		return Subject::orderBy('id', 'asc')
						->paginate(pagination_pages());
	}

}
