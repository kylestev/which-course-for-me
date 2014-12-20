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
						->whereSubjectId($subject_id)
						->paginate(25);
		}
		catch (ModelNotFoundException $e)
		{
			throw new NotFoundException('Course not found');
		}
	}

	public function all()
	{
		return Course::with('subject')
					->orderBy('id', 'asc')
					->paginate(25)
					->toArray();
	}

}
