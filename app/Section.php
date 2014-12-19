<?php namespace Courses;

use Illuminate\Database\Eloquent\Model;

class Section extends Model {

	protected $table = 'sections';

	public function course()
	{
		return $this->belongsTo('\Courses\Course');
	}

	public function enrollment_current()
	{
		return $this->hasOne('\Courses\SectionEnrollment', 'id', 'current_enrollment_id');
	}

	public function enrollment_waitlist()
	{
		return $this->hasOne('\Courses\SectionEnrollment', 'id', 'waitlist_enrollment_id');
	}

	public function instructor()
	{
		return $this->hasOne('\Courses\Instructor', 'id', 'instructor_id');
	}

	public function section_type()
	{
		return $this->hasOne('\Courses\SectionType', 'id', 'section_type_id');
	}

}
