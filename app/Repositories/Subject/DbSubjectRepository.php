<?php

namespace Courses\Repositories\Subject;

use Courses\Exceptions\NotFoundException;
use Courses\Subject;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DbSubjectRepository implements SubjectRepositoryInterface
{

    public function find($id)
    {
        try {
            return Subject::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException('Subject not found');
        }
    }

    public function paginateResults()
    {
        return Subject::orderBy('id', 'asc')
            ->skip((\Request::input('page', 1) - 1) * pagination_pages())
            ->take(pagination_pages())
            ->get();
    }

    public function getPaginator($per_page = 15)
    {
        return Subject::paginate($per_page);
    }

}
