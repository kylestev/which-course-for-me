<?php namespace Courses\Transformers;

class InstructorTransformer extends Transformer {

	protected function transformItem($item)
	{
		return [
			'id' => (int) $item['id'],
			'name' => $item['name'],
			'email' => $item['email'],
		];
	}

	protected function getLinkParams()
	{
		return [
			'instructor' => ['instructors.show', ['id']],
			'instructors' => ['instructors.index', []],
		];
	}

}
