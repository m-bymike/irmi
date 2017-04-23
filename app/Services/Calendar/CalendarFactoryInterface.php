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

namespace Irma\Services\Calendar;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Irma\Reservation;

interface CalendarFactoryInterface
{
    public function addReservations(Collection $reservations) : CalendarFactoryInterface;
    public function addReservation(Reservation $reservation) : CalendarFactoryInterface;
    public function render() : string;
    public function applyTo(Response $response, string $filename = 'irma.ics') : Response;
}
