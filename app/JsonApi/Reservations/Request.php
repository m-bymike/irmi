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

        // start datetime
        'start',
        'start|lt',
        'start|le',
        'start|gt',
        'start|ge',

        // end datetime
        'end',
        'end|lt',
        'end|le',
        'end|gt',
        'end|ge',
    ];

    protected $allowedIncludePaths = [
        'aircraft',
        'member',
    ];
}
