<?php namespace Courses\Repositories\Instructor;

use Paginator;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Courses\Instructor;
use Courses\Exceptions\NotFoundException;

class DbInstructorRepository implements InstructorRepositoryInterface {
	
	public function find($id)
	{
		try
		{
			return Instructor::findOrFail($id)
							->toArray();
		}
		catch (ModelNotFoundException $e)
		{
			throw new NotFoundException(sprintf('Instructor (%d) not found', $id));
		}
	}

	public function paginateResults()
	{
		return Instructor::paginate(pagination_pages());
	}

}
