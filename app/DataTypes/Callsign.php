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

final class Callsign
{
    private $country = '';
    private $registration = '';

    /**
     * @param string $callsign
     *
     * @return Callsign
     */
    public static function createFromString(string $callsign) : Callsign
    {
        if (preg_match('/^([a-z]+)-([a-z]+)$/i', $callsign, $matches) !== 1) {
            throw new \InvalidArgumentException();
        }

        return new self(strtoupper($matches[1]), strtoupper($matches[2]));
    }

    /**
     * Callsign constructor.
     *
     * @param string $country
     * @param string $registration
     */
    public function __construct(string $country, string $registration)
    {
        $this->country = $country;
        $this->registration = $registration;
    }

    public function __toString() : string
    {
        return $this->country . '-' . $this->registration;
    }
}
