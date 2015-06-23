<?php

namespace Courses;

use Illuminate\Database\Eloquent\Model;

class SectionEnrollment extends Model
{

    protected $table = 'section_enrollments';

    protected $casts = [
        'cap'       => 'int',
        'available' => 'int',
        'current'   => 'int',
    ];

}
