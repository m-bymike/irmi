<?php

namespace Irma\JsonApi\Aircraft;

use CloudCreativity\JsonApi\Http\Requests\RequestHandler;

class Request extends RequestHandler
{

    /**
     * @var array
     */
    protected $hasOne = [
        //
    ];

    /**
     * @var array
     */
    protected $hasMany = [
        //
    ];

    /**
     * @var array
     */
    protected $allowedFilteringParameters = [
        'id',
    ];
}

