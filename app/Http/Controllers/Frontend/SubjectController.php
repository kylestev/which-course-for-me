<?php namespace Courses\Http\Controllers\Frontend;

use Courses\Repositories\Course\CourseRepositoryInterface;
use Courses\Repositories\Subject\SubjectRepositoryInterface;
use Illuminate\Http\Request;

class SubjectController extends FrontendController
{

    public function index(SubjectRepositoryInterface $repo, Request $request)
    {
        $page      = $request->input('page', 1);
        $paginator = $repo->getPaginator();
        $paginator->setPath('/' . $request->path());

        return $this->view->make('frontend.subjects.index', [
            'subjects' => $paginator,
        ]);
    }

    public function show(
        SubjectRepositoryInterface $subjectRepo,
        CourseRepositoryInterface $repo,
        $subject_id,
        Request $request
    ) {
        $subj      = $subjectRepo->find($subject_id);
        $page      = $request->input('page', 1);
        $paginator = $repo->getPaginator($subject_id);
        $paginator->setPath('/' . $request->path());

        return $this->view->make('frontend.subjects.show', [
            'subj'        => $subj,
            'courses'     => $paginator,
            'single_page' => true,
            'title'       => sprintf('Which Course For Me | %s (%s) Courses', $subj['name'], $subj['id']),
        ]);
    }

}
