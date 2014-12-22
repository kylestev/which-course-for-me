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

	private function getAll()
	{
		return SectionType::orderBy('id', 'asc');
	}

	public function all()
	{
		return $this->getAll()->toArray();
	}

	public function paginateResults()
	{
		return $this->getAll()
					->paginate(pagination_pages())
					->toArray();
	}

}
