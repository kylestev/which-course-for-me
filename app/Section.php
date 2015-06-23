<?php

namespace Courses;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    protected $table = 'sections';

    protected $casts = [
        'id'             => 'int',
        'credits'        => 'int',
        'section_number' => 'int',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function enrollment_current()
    {
        return $this->hasOne(SectionEnrollment::class, 'id', 'current_enrollment_id');
    }

    public function enrollment_waitlist()
    {
        return $this->hasOne(SectionEnrollment::class, 'id', 'waitlist_enrollment_id');
    }

    public function instructor()
    {
        return $this->hasOne(Instructor::class, 'id', 'instructor_id');
    }

    public function section_type()
    {
        return $this->hasOne(SectionType::class, 'id', 'section_type_id');
    }

}
