<?php

namespace Courses\Repositories\Instructor;

use Courses\Exceptions\NotFoundException;
use Courses\Instructor;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DbInstructorRepository implements InstructorRepositoryInterface
{

    public function find($id)
    {
        try
        {
            return Instructor::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException(sprintf('Instructor (%d) not found', $id));
        }
    }

    public function paginateResults()
    {
        return Instructor::skip((\Request::input('page', 1) - 1) * pagination_pages())
            ->take(pagination_pages())
            ->get();
    }

}
