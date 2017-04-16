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

use Irma\Reservation;
use Irma\JsonApi\Reservations\Search;
use Irma\JsonApi\Reservations\Request;
use CloudCreativity\LaravelJsonApi\Http\Controllers\EloquentController;

class ReservationsController extends EloquentController
{
    /**
     * MembersController constructor.
     *
     * @param Reservation $reservation
     * @param Search      $search
     */
    public function __construct(Reservation $reservation, Search $search)
    {
        parent::__construct($reservation, null, $search);
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

