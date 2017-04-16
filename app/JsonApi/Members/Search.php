<?php

namespace Irma\JsonApi\Members;

use CloudCreativity\LaravelJsonApi\Search\AbstractSearch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Search extends AbstractSearch
{
    /**
     * @var int
     */
    protected $maxPerPage = 100;

    /**
     * @param Builder $builder
     * @param Collection $filters
     */
    protected function filter(Builder $builder, Collection $filters)
    {
        if ($filters->has('irma-id')) {
            $builder->where('irma_id', $filters->get('irma-id'));
        }

        if ($filters->has('irma-ids')) {
            $builder->whereIn('irma_id', explode(',', $filters->get('irma-ids')));
        }
    }

    /**
     * @param Collection $filters
     * @return bool
     */
    protected function isSearchOne(Collection $filters)
    {
        return $filters->has('irma-id');
    }
}
