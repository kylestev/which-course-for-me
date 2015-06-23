<?php

namespace Courses\Repositories\SectionType;

use Courses\Exceptions\NotFoundException;
use Courses\SectionType;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DbSectionTypeRepository implements SectionTypeRepositoryInterface
{

    public function find($id)
    {
        try {
            return SectionType::findOrFail($id);
        } catch (ModelNotFoundException $e) {
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
                    ->skip((\Request::input('page', 1) - 1) * pagination_pages())
                    ->take(pagination_pages())
                    ->get();
    }

}
