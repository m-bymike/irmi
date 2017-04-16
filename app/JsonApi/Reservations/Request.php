<?php

namespace Irma\JsonApi\Reservations;

use CloudCreativity\JsonApi\Http\Requests\RequestHandler;

class Request extends RequestHandler
{

    /**
     * @var array
     */
    protected $hasOne = [
        'aircraft',
        'member',
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
        'member.id',
        'member.irma_id',
        'aircraft.callsign',
    ];

    protected $allowedIncludePaths = [
        'aircraft',
        'member',
    ];
}
