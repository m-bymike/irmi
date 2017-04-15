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

use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;
use Irma\JsonApi\Members\Request;
use Irma\JsonApi\Members\Search;
use Irma\Member;

class MembersController extends EloquentController
{
    /**
     * MembersController constructor.
     *
     * @param Member $member
     * @param Search $search
     */
    public function __construct(Member $member, Search $search)
    {
        parent::__construct($member, null, $search);
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
