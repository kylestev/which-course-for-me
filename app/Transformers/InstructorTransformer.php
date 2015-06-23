<?php

namespace Courses\Transformers;

use Courses\Instructor;
use League\Fractal\TransformerAbstract;

class InstructorTransformer extends TransformerAbstract
{

    public function transform(Instructor $instructor)
    {
        return [
            'id'    => $instructor->id,
            'name'  => $instructor->name,
            'email' => $instructor->email,
        ];
    }

    protected function getLinkParams()
    {
        return [
            'instructor'  => ['instructors.show', ['id']],
            'instructors' => ['instructors.index', []],
        ];
    }

}
