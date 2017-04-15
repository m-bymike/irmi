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
    const TYPE_RESERVATION = 'reservation';
    const TYPE_BLOCKED = 'blocked';

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
     * @var string
     */
    private $type;

    /**
     * Reservation constructor.
     *
     * @param Callsign $callsign
     * @param Carbon   $start
     * @param Carbon   $end
     * @param int      $userId
     * @param string   $type
     */
    public function __construct(Callsign $callsign, Carbon $start, Carbon $end, int $userId, string $type)
    {
        $this->callsign = $callsign;
        $this->start = $start;
        $this->end = $end;
        $this->userId = $userId;

        if (!in_array($type, [self::TYPE_BLOCKED, self::TYPE_RESERVATION])) {
            throw new \InvalidArgumentException();
        }

        $this->type = $type;
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

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
