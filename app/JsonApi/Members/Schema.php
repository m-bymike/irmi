<?php

namespace Irma\JsonApi\Members;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    const RESOURCE_TYPE = 'members';

    /**
     * @var array|null
     */
    protected $attributes = null;

    /**
     * @return string
     */
    public function getResourceType()
    {
        return self::RESOURCE_TYPE;
    }
}

