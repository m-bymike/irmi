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
        //
    }

    /**
     * @param Collection $filters
     * @return bool
     */
    protected function isSearchOne(Collection $filters)
    {
        //
    }
}
