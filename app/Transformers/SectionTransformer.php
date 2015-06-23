<?php

namespace Courses\Transformers;

use Courses\Section;
use League\Fractal\TransformerAbstract;

class SectionTransformer extends TransformerAbstract
{

    public $availableIncludes = ['course'];
    public $defaultIncludes   = ['instructor', 'section_type', 'subject'];

    public function transform(Section $section)
    {
        return [
            'id'                  => $section->id,
            'course_id'           => $section->course_id,

            'enrollment_current'  => [
                'cap'       => $section->enrollment_current->cap,
                'current'   => $section->enrollment_current->current,
                'available' => max($section->enrollment_current->available, 0),
            ],

            'enrollment_waitlist' => [
                'cap'       => $section->enrollment_waitlist->cap,
                'current'   => $section->enrollment_waitlist->current,
                'available' => max($section->enrollment_waitlist->available, 0),
            ],

            'credits'             => $section->credits,
            'term'                => $section->term,
            'section_number'      => $section->section_number,
            'fees'                => $section->fees,
            'notes'               => $section->notes,
        ];
    }

    public function includeCourse(Section $section)
    {
        return $this->item($section->course, new CourseTransformer);
    }

    public function includeInstructor(Section $section)
    {
        return $this->item($section->instructor, new InstructorTransformer);
    }

    public function includeSectionType(Section $section)
    {
        return $this->item($section->section_type, new SectionTypeTransformer);
    }

    public function includeSubject(Section $section)
    {
        return $this->item($section->course->subject, new SubjectTransformer);
    }

    protected function getLinkParams()
    {
        return [
            'course'       => ['subjects.courses.show', ['id']],
            'section'      => ['subjects.courses.sections.show', ['course_id', 'id']],
            'sections'     => ['subjects.courses.sections.show', ['id']],
            'section_type' => ['section_types.show', ['section_type.section_type_id']],
            'subject'      => ['subjects.show', ['subject.subject_id']],
        ];
    }

}
