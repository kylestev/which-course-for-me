<?php namespace Courses;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model {

	protected $table = 'subjects';

	public static function bySubjcode($subjcode)
	{
		return Subject::whereSubjcode($subjcode)->first();
	}

	public function courses()
	{
		return $this->hasMany('\Courses\Course');
	}

}
