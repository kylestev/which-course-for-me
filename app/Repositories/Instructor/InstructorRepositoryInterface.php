<?php namespace Courses\Repositories\Instructor;

use Courses\Repositories\RepositoryInterface;

interface InstructorRepositoryInterface extends RepositoryInterface {

	public function all();
	public function find($id);

}
