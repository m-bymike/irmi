<?php
/**
 * ----------------------------------------------------------------------------
 * This code is part of the Sclable Business Application Development Platform
 * and is subject to the provisions of your License Agreement with
 * Sclable Business Solutions GmbH.
 *
 * @copyright (c) 2017 Sclable Business Solutions GmbH
 * ----------------------------------------------------------------------------
 */

namespace Irma\Http\Controllers\Api;

use Irma\Aircraft;
use Irma\JsonApi\Aircraft\Search;
use Irma\JsonApi\Aircraft\Request;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;

class AircraftController extends EloquentController
{
    /**
     * MembersController constructor.
     *
     * @param Aircraft $aircraft
     * @param Search   $search
     */
    public function __construct(Aircraft $aircraft, Search $search)
    {
        parent::__construct($aircraft, null, $search);
    }


    /**
     * Get the fully qualified name of the request handler to use for this controller.
     *
     * @return string
     */
    protected function getRequestHandler() : string
    {
        return Request::class;
    }
}

