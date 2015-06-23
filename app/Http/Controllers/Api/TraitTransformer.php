<?php

namespace Courses\Http\Controllers\Api;

use League\Fractal;

trait TraitTransformer
{

    protected function transformData($data)
    {
        if (array_key_exists('data', $data)) {
            throw new \Exception('.');
        } else {
            $manager = new Fractal\Manager;
            $manager->setSerializer(new Fractal\Serializer\ArraySerializer);

            if (is_array($data)) {
                return $manager->createData(new Fractal\Resource\Collection($data, $this->transformer))->toArray();
            }

            return $manager->createData(new Fractal\Resource\Item($data, $this->transformer))->toArray();
        }
    }

    /**
     * Used to create a pretty-printed JSON Response object with the provided
     * data.
     *
     * @param  array $data either an associative array describing a single
     *            item, or an array of items.
     * @return Response
     **/
    protected function createJsonResponse($data)
    {
        if (!is_null($this->transformer)) {
            $data = $this->transformData($data);
        }

        $this->response->setData($data);
        $this->response->setJsonOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        return $this->response;
    }

}
