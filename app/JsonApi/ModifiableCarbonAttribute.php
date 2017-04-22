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

use Carbon\Carbon;

class ModifiableCarbonAttribute extends AbstractModifiableAttribute
{
    /**
     * @param string $value
     *
     * @return Carbon
     */
    public function parse(string $value)
    {
        switch ($value) {
            case 'today':
                return Carbon::today();

            case 'yesterday':
                return Carbon::yesterday();

            case 'tomorrow':
                return Carbon::tomorrow();

            case 'now':
                return Carbon::now();

            default:
                return Carbon::parse($value);
        }
    }
}
