<?php

namespace Irma\JsonApi\Members;

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
        'reservations',
    ];

    /**
     * @var array
     */
    protected $allowedFilteringParameters = [
        'id',
        'irma-id',
        'irma-ids',
    ];

    protected $allowedIncludePaths = [];
}

