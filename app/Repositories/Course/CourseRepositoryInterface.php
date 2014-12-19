<?php namespace Courses\Repositories\Course;

use Courses\Repositories\RepositoryInterface;

interface CourseRepositoryInterface extends RepositoryInterface {

	public function all();
	public function find($id);
	public function findBySubjectId($subject_id);

}
