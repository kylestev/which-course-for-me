<?php namespace Courses\Repositories\Section;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Courses\Course;
use Courses\Section;
use Courses\Exceptions\NotFoundException;

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

	private function getAllByCourseId($courseId)
	{
		return Section::with('section_type', 'course.subject', 'enrollment_current', 'enrollment_waitlist', 'instructor')
						->whereCourseId($courseId);
	}

	public function all($courseId)
	{
		return $this->getAllByCourseId($courseId)->get()->toArray();
	}

	public function find($courseId, $crn)
	{
		try
		{
			return $this->getAllByCourseId($courseId)
							->findOrFail($crn)
							->toArray();
		}
		catch (ModelNotFoundException $e)
		{
			throw new NotFoundException(sprintf('Section (%s) not found under Course (%s)', $crn, $courseId));
		}
	}

	public function paginateResults($courseId)
	{
		$results = $this->getAllByCourseId($courseId);
		$paginated = $results->paginate(pagination_pages())->toArray();
		array_set($paginated, 'data', array_get($paginated, 'data'));
		return $paginated;
	}

}
