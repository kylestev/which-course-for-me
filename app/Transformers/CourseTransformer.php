<?php namespace Courses\Transformers;

class CourseTransformer extends Transformer {

	protected function transformItem($item)
	{
		return [
			'id' => array_get($item, 'id'),
			'level' => (int) array_get($item, 'level'),
			'title' => title_case(array_get($item, 'title')),
			'description' => array_get($item, 'description'),
			'prereqs' => array_get($item, 'prereqs'),
			'subject' => [
				'subject_id' => array_get($item, 'subject.id'),
				'name' => array_get($item, 'subject.name'),
			],
		];
	}

	protected function getLinkParams()
	{
		return [
			'course' => ['courses.show', ['id']],
			'subject' => ['subjects.show', ['subject.subject_id']],
		];
	}

}
