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

    public function getPaginator($page, $per_page = 15)
    {
        $count = Subject::count();
        $items = Subject::orderBy('id', 'asc')
            ->skip(($page - 1) * $per_page)
            ->take($per_page)
            ->get();

        return new \Illuminate\Pagination\LengthAwarePaginator($items, $count, $per_page, $page);
    }

}
