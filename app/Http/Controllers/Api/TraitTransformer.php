<?php namespace Courses\Http\Controllers\Api;

trait TraitTransformer {

	protected function transformData($data)
	{
		if (array_key_exists('data', $data))
		{
			return array_set($data, 'data', $this->transformer->transform(array_get($data, 'data')));
		}
		else
		{
			return [ 'data' => $this->transformer->transform($data) ];
		}
	}

	/**
	 * Used to create a pretty-printed JSON Response object with the provided
	 * data.
	 *
	 * @param  array $data either an associative array describing a single
	 *			item, or an array of items.
	 * @return Response
	 **/
	protected function createJsonResponse($data)
	{
		if (! is_null($this->transformer))
		{
			$data = $this->transformData($data);
		}

		$this->response->setData($data);
		$this->response->setJsonOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

		return $this->response;
	}

}