<?php

namespace Courses;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{

    protected $table = 'instructors';

    protected $fillable = ['name', 'email'];

    protected $casts = [
        'id' => 'int',
    ];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

}
