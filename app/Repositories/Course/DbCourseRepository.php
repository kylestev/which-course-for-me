<?php namespace Courses\Repositories\Course;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Courses\Course;
use Courses\Exceptions\NotFoundException;

class DbCourseRepository implements CourseRepositoryInterface {

	public function find($course_id)
	{
		try
		{
			return Course::with('subject')
					->findOrFail($course_id)
					->toArray();
		}
		catch (ModelNotFoundException $e)
		{
			throw new NotFoundException(sprintf('Course (%s) not found', $course_id));
		}
	}

	public function findBySubjectId($subject_id)
	{
		try
		{
			return Course::with('subject')
						->whereSubjectId($subject_id);
		}
		catch (ModelNotFoundException $e)
		{
			throw new NotFoundException('Course not found');
		}
	}

	public function paginateResults($subject_id)
	{
		$res = $this->findBySubjectId($subject_id)->paginate(pagination_pages());

		return $res;
	}

}
