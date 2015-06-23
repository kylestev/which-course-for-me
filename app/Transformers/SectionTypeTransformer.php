<?php

namespace Courses\Transformers;

use Courses\SectionType;
use League\Fractal\TransformerAbstract;

class SectionTypeTransformer extends TransformerAbstract
{

    public function transform(SectionType $sectionType)
    {
        return [
            'id'   => $sectionType->id,
            'name' => $sectionType->name,
        ];
    }

    protected function getLinkParams()
    {
        return [
            'section_type'  => ['section_types.show', ['id']],
            'section_types' => ['section_types.index', []],
        ];
    }

}
