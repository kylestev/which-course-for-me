<?php namespace Courses\Transformers;

class SectionTransformer extends Transformer {

	protected function transformItem($item)
	{
		return [
			'id' => (int) array_get($item, 'id'),
			'course_id' => array_get($item, 'course_id'),

			'subject' => [
				'subject_id' => array_get($item, 'course.subject.id'),
				'name' => array_get($item, 'course.subject.name'),
			],

			'instructor' => [
				'instructor_id' => (int) array_get($item, 'instructor.id'),
				'name' => array_get($item, 'instructor.name'),
				'email' => array_get($item, 'instructor.email'),
			],

			'section_type' => [
				'section_type_id' => (int) array_get($item, 'section_type.id'),
				'name' => array_get($item, 'section_type.name'),
			],

			'enrollment_current' => [
				'cap' => (int) array_get($item, 'enrollment_current.cap'),
				'current' => (int) array_get($item, 'enrollment_current.current'),
				'available' => max((int) array_get($item, 'enrollment_current.available'), 0),
			],

			'enrollment_waitlist' => [
				'cap' => (int) array_get($item, 'enrollment_waitlist.cap'),
				'current' => (int) array_get($item, 'enrollment_waitlist.current'),
				'available' => max((int) array_get($item, 'enrollment_waitlist.available'), 0),
			],

			'credits' => (int) array_get($item, 'credits'),
			'term' => array_get($item, 'term'),
			'section_number' => (int) array_get($item, 'section_number'),
			'fees' => array_get($item, 'fees'),
			'notes' => array_get($item, 'notes'),
			// 'updated_at' => $item['updated_at'],
		];
	}

	protected function getLinkParams()
	{
		return [
			'course' => ['subjects.courses.show', ['id']],
			'section' => ['subjects.courses.sections.show', ['course_id', 'id']],
			'sections' => ['subjects.courses.sections.show', ['id']],
			'section_type' => ['section_types.show', ['section_type.section_type_id']],
			'subject' => ['subjects.show', ['subject.subject_id']],
		];
	}

}
