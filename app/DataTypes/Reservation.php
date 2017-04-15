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

namespace Irma\DataTypes;

use Carbon\Carbon;

final class Reservation
{
    /**
     * @var Callsign
     */
    private $callsign;

    /**
     * @var Carbon
     */
    private $start;

    /**
     * @var Carbon
     */
    private $end;

    /**
     * @var int
     */
    private $userId;

    /**
     * Reservation constructor.
     *
     * @param Callsign $callsign
     * @param Carbon   $start
     * @param Carbon   $end
     * @param int      $userId
     */
    public function __construct(Callsign $callsign, Carbon $start, Carbon $end, int $userId)
    {
        $this->callsign = $callsign;
        $this->start = $start;
        $this->end = $end;
        $this->userId = $userId;
    }

    /**
     * @return Callsign
     */
    public function getCallsign(): Callsign
    {
        return $this->callsign;
    }

    /**
     * @return Carbon
     */
    public function getStart(): Carbon
    {
        return $this->start;
    }

    /**
     * @return Carbon
     */
    public function getEnd(): Carbon
    {
        return $this->end;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}
