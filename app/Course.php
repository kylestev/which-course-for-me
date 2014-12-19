<?php namespace Courses;

use Illuminate\Database\Eloquent\Model;

class Course extends Model {

	protected $table = 'courses';

	public function sections()
	{
		return $this->hasMany('\Courses\Section');
	}

	public function current_sections()
	{
		return $this->sections()->whereTerm(env('CURRENT_TERM'))->count();
	}

	public function subject()
	{
		return $this->belongsTo('\Courses\Subject', 'subject_id', 'id');
	}

}
