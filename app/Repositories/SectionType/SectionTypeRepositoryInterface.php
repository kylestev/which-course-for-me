<?php namespace Courses\Repositories\SectionType;

use Courses\Repositories\RepositoryInterface;

interface SectionTypeRepositoryInterface extends RepositoryInterface {

	public function all();
	public function find($id);
	public function paginateResults();

}
