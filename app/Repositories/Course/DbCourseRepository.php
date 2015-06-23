<?php namespace Courses\Repositories\Course;

use Courses\Course;
use Courses\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DbCourseRepository implements CourseRepositoryInterface
{

    public function find($course_id)
    {
        try {
            return Course::with('subject')->findOrFail($course_id);
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException(sprintf('Course (%s) not found', $course_id));
        }
    }

    public function findBySubjectId($subject_id)
    {
        return Course::with('subject')->whereSubjectId($subject_id);
    }

    public function paginateResults($subject_id)
    {
        return $this->findBySubjectId($subject_id)
                    ->skip((\Request::input('page', 1) - 1) * pagination_pages())
                    ->take(pagination_pages())
                    ->get();
    }

}
