<?php namespace Courses\Http\Controllers\Frontend;

use Courses\Course;
use Courses\Subject;
use Courses\Repositories\Subject\SubjectRepositoryInterface;
use Courses\Repositories\Course\CourseRepositoryInterface;
use Courses\Transformers\CourseTransformer;

class SubjectController extends FrontendController {

	public function index(SubjectRepositoryInterface $repo)
	{
		return $this->view->make('frontend.subjects.index', [
			'subjects' => $repo->all(),
		]);
	}

	public function show(
		CourseRepositoryInterface $repo,
		$subject_id
	)
	{
		$courses = $repo->findBySubjectId($subject_id);

		return $this->view->make('frontend.subjects.show', [
			'subject_id' => $subject_id,
			'courses' => $courses,
			'single_page' => true,
		]);
	}

}
