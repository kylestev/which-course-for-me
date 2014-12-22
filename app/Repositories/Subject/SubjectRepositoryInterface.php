<?php namespace Courses\Repositories\Subject;

use Courses\Repositories\RepositoryInterface;

interface SubjectRepositoryInterface extends RepositoryInterface {

	public function find($id);
	public function paginateResults();

}
