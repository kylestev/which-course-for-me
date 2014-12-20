<?php namespace Courses\Repositories\SectionType;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Courses\SectionType;
use Courses\Exceptions\NotFoundException;

class DbSectionTypeRepository implements SectionTypeRepositoryInterface {

	public function find($id)
	{
		try
		{
			return SectionType::findOrFail($id)
								->toArray();
		}
		catch (ModelNotFoundException $e)
		{
			throw new NotFoundException(sprintf('SectionType (%s) not found.', $id));
		}
	}

	public function all()
	{
		return SectionType::orderBy('id', 'asc')
							->paginate(25)
							->toArray();
	}

}
