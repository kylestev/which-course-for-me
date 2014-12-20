<?php namespace Courses\Repositories\Section;

use Courses\Course;
use Courses\Section;

class DbCourseSectionRepository implements CourseSectionRepositoryInterface {

	private function sortSections($sections)
	{
		$sorts = ['F' => 1, 'W' => 2, 'Sp' => 3, 'Su' => 4];

		return array_sort($sections, function ($section) use ($sorts)
		{
			$term = array_get($section, 'term');
			$year = substr($term, -2);
			$quarter = substr($term, 0, strlen($term) - 2);

			return [$year, array_get($sorts, $quarter), array_get($section, 'section_number')];
		});
	}

	public function all($courseId, $paginate = true)
	{
		$res = Section::with('section_type', 'course.subject', 'enrollment_current', 'enrollment_waitlist', 'instructor')
						->whereCourseId($courseId);

		if ($paginate)
		{
			return $res->paginate(25)->toArray();
		}
		else
		{
			return $this->sortSections($res->get()->toArray());
		}
	}

	public function find($courseId, $crn)
	{
		return Section::with('section_type', 'course.subject', 'enrollment_current', 'enrollment_waitlist', 'instructor')
						->findOrFail($crn)
						->toArray();
	}

	public function getAllByCourseId($courseId)
	{
		return Course::with('section_type', 'course.subject', 'enrollment_current', 'enrollment_waitlist', 'instructor')
						->findOrFail($courseId)
						->sections()
						->paginate(250)
						->toArray();
	}

}
