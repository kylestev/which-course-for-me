<?php namespace Courses;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model {

	protected $table = 'instructors';

	protected $fillable = ['name', 'email'];

	public function sections()
	{
		return $this->hasMany('\Courses\Section');
	}

}
