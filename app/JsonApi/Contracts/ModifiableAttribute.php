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

namespace Irma\JsonApi\Contracts;

/**
 * @const string MODIFIER_SEPARATOR
 */
interface ModifiableAttribute
{
    const MODIFIER_SEPARATOR = '|';

    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @param string $modifier
     *
     * @return string
     */
    public function getFilterKey(string $modifier = '') : string;

    /**
     * @param string $value
     *
     * @return mixed
     */
    public function parse(string $value);
}
