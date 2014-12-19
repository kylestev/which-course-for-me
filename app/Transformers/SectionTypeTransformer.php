<?php namespace Courses\Transformers;

class SectionTypeTransformer extends Transformer {

	protected function transformItem($item)
	{
		return [
			'id' => array_get($item, 'id'),
			'name' => array_get($item, 'name'),
		];
	}

	protected function getLinkParams()
	{
		return [
			'section_type' => ['section_types.show', ['id']],
			'section_types' => ['section_types.index', []],
		];
	}

}
