<?php namespace Courses\Repositories\Section;

use Courses\Repositories\RepositoryInterface;

interface CourseSectionRepositoryInterface extends RepositoryInterface {

	public function all($courseId);
	public function find($courseId, $crn);
	public function paginateResults($courseId);

}
