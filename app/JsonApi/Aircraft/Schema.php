<?php

namespace Irma\JsonApi\Aircraft;

use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

class Schema extends EloquentSchema
{

    /**
     * @var string
     */
    const RESOURCE_TYPE = 'aircraft';

    /**
     * @var array|null
     */
    protected $attributes = [
        'callsign' => 'callsign',
        'type' => 'icao_type',
    ];

    /**
     * @return string
     */
    public function getResourceType()
    {
        return self::RESOURCE_TYPE;
    }
}

