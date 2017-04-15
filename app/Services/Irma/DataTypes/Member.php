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

namespace Irma\Services\Irma\DataTypes;

final class Member
{
    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var int
     */
    private $memberId;

    /**
     * Member constructor.
     *
     * @param string $lastName
     * @param string $firstName
     * @param int    $memberId
     */
    public function __construct(string $lastName, string $firstName, int $memberId)
    {
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->memberId = $memberId;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return int
     */
    public function getMemberId(): int
    {
        return $this->memberId;
    }
}
