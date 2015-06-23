<?php

namespace Courses\Transformers;

use Courses\Course;
use League\Fractal\TransformerAbstract;

class CourseTransformer extends TransformerAbstract
{

    public $defaultIncludes = ['subject'];

    public function transform(Course $course)
    {
        return [
            'id'          => $course->id,
            'level'       => $course->level,
            'title'       => $course->title,
            'description' => $course->description,
            'prereqs'     => $course->prereqs,
        ];
    }

    public function includeSubject(Course $course)
    {
        return $this->item($course->subject, new SubjectTransformer);
    }

    protected function getLinkParams()
    {
        return [
            'course'   => ['subjects.courses.show', ['id']],
            'subject'  => ['subjects.show', ['subject.subject_id']],
            'sections' => ['subjects.courses.sections.index', ['subject.subject_id', 'id']],
        ];
    }

}
