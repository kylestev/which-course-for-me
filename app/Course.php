<?php namespace Courses;

use Illuminate\Database\Eloquent\Model;

class Course extends Model {

	protected $table = 'courses';

	public function sections()
	{
		return $this->hasMany('\Courses\Section');
	}

	public function subject()
	{
		return $this->belongsTo('\Courses\Subject', 'subject_id', 'id');
	}

}
