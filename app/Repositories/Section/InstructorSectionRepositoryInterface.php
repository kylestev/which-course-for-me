<?php namespace Courses\Repositories\Section;

use Courses\Repositories\RepositoryInterface;

interface InstructorSectionRepositoryInterface extends RepositoryInterface {

	public function all($instructorId);
	public function find($instructorId, $crn);
	public function getAllByInstructorId($instructorId);

}
