<?php namespace Courses\Repositories\SectionType;

use Courses\SectionType;

class DbSectionTypeRepository implements SectionTypeRepositoryInterface {

	public function find($id)
	{
		return SectionType::findOrFail($id)
							->first()
							->toArray();
	}

	public function all()
	{
		return SectionType::orderBy('id', 'asc')
							->paginate(25)
							->toArray();
	}

}
