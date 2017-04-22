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

interface ModifiableAttributeCollection
{
    /**
     * @param ModifiableAttribute $attribute
     *
     * @return ModifiableAttributeCollection
     */
    public function add(ModifiableAttribute $attribute) : ModifiableAttributeCollection;

    /**
     * @return array|ModifiableAttribute[]
     */
    public function all() : array;
}
