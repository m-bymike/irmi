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

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use CloudCreativity\LaravelJsonApi\Schema\EloquentSchema;

abstract class AbstractSchema extends EloquentSchema
{
    /**
     * @param Model|Collection $data
     * @param bool             $showSelf
     * @param bool             $showRelated
     *
     * @return array
     */
    protected function makeRelationshipArray($data, bool $showSelf = true, bool $showRelated = true) : array
    {
        return [
            self::DATA => $data,
            self::SHOW_SELF => $showSelf,
            self::SHOW_RELATED => $showRelated,
        ];
    }
}
