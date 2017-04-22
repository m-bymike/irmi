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
use Illuminate\Database\Eloquent\Builder;
use Irma\JsonApi\Contracts\ModifiableAttributeCollection;

trait ModifiableFilters
{
    /**
     * @var array
     */
    protected $modifiers = [
        '' => '=',
        'eq' => '=',
        'ge' => '>=',
        'gt' => '>',
        'le' => '<=',
        'lt' => '<',
    ];

    /**
     * @param Builder    $builder
     * @param Collection $filters
     *
     * @return void
     */
    protected function filterWithModifiers(Builder $builder, Collection $filters)
    {
        $attributes = $this->getModifiableAttributes();

        foreach ($attributes->all() as $attribute) {
            foreach ($this->modifiers as $modifier => $operator) {
                $filterKey = $attribute->getFilterKey($modifier);
                if ($filters->has($filterKey)) {
                    $value = $attribute->parse($filters->get($filterKey));
                    $builder->where($attribute->getName(), $operator, $value);
                }
            }
        }
    }

    /**
     * Get a list of modifiable attributes.
     * @return ModifiableAttributeCollection
     */
    abstract protected function getModifiableAttributes() : ModifiableAttributeCollection;
}
