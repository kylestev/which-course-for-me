<?php namespace Courses\Transformers;

abstract class Transformer {

	protected abstract function getLinkParams();
	protected abstract function transformItem($item);

	private function applyTransforms(&$item)
	{
		$item = $this->transformItem($item);

		array_set($item, '_links', $this->getLinks($item));

		return $item;
	}

	protected function getLinks($item)
	{
		return array_map(function ($params) use ($item) {
			$values = array_map(function ($key) use ($item) {
				return array_get($item, $key);
			}, $params[1]);

			return route($params[0], $values);
		}, $this->getLinkParams());
	}

	public function transform($data)
	{
		if (! is_assoc($data))
		{
			return $this->transformCollection($data);
		}

		return $this->applyTransforms($data);
	}

	protected function transformCollection(array $items)
	{
		return array_map([$this, 'applyTransforms'], $items);
	}

}
