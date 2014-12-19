<?php namespace Courses\Repositories\Section;

use Courses\Course;
use Courses\Section;

class DbInstructorSectionRepository implements InstructorSectionRepositoryInterface {

	public function all($instructorId)
	{
		return Section::whereInstructorId($instructorId)->paginate(25);
	}

	public function find($instructorId, $crn)
	{
		return Section::findOrFail($crn);
	}

	public function getAllByInstructorId($instructorId)
	{
		return Instructor::findOrFail($instructorId)->sections()->paginate(25);
	}

}
