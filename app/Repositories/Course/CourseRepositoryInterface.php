<?php namespace Courses\Repositories\Course;

use Courses\Repositories\RepositoryInterface;

interface CourseRepositoryInterface extends RepositoryInterface
{

    public function find($id);
    public function paginateResults($subject_id);
    public function findBySubjectId($subject_id);
    public function getPaginator($subject_id, $page, $per_page = 15);

}
