<?php

namespace Courses\Transformers;

use Courses\Subject;
use League\Fractal\TransformerAbstract;

class SubjectTransformer extends TransformerAbstract
{

    public function transform(Subject $subject)
    {
        return [
            'id'   => $subject->id,
            'name' => $subject->name,
        ];
    }

    protected function getLinkParams()
    {
        return [
            'courses'  => ['subjects.courses.index', ['id']],
            'subject'  => ['subjects.show', ['id']],
            'subjects' => ['subjects.index', []],
        ];
    }

}
