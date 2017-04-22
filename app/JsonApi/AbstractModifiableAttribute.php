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

namespace Irma\JsonApi;

use Irma\JsonApi\Contracts\ModifiableAttribute;

abstract class AbstractModifiableAttribute implements ModifiableAttribute
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     *
     * @return static
     */
    public static function create(string $name)
    {
        return new static($name);
    }

    /**
     * AbstractModifiableAttribute constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $modifier
     *
     * @return string
     */
    public function getFilterKey(string $modifier = ''): string
    {
        if (empty($modifier)) {
            return $this->name;
        }

        return $this->name . static::MODIFIER_SEPARATOR . $modifier;
    }
}
