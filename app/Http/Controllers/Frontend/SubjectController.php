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
			'subjects' => $repo->paginateResults(),
		]);
	}

	public function show(
		SubjectRepositoryInterface $subjectRepo,
		CourseRepositoryInterface $repo,
		$subject_id
	)
	{
		$subj = $subjectRepo->find($subject_id);
		$courses = $repo->paginateResults($subject_id);

		return $this->view->make('frontend.subjects.show', [
			'subj' => $subj,
			'courses' => $courses,
			'single_page' => true,
			'title' => sprintf('Which Course For Me | %s (%s) Courses', $subj['name'], $subj['id']),
		]);
	}

}
