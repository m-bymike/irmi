<?php

namespace Irma\JsonApi\Reservations;

use CloudCreativity\LaravelJsonApi\Search\AbstractSearch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Irma\Aircraft;

class Search extends AbstractSearch
{
    protected $maxPerPage = 100;

    /**
     * @param Builder $builder
     * @param Collection $filters
     */
    protected function filter(Builder $builder, Collection $filters)
    {
        if ($filters->has('aircraft.callsign')) {
            $callsign = $filters->get('aircraft.callsign');
            $builder->whereHas('aircraft', function ($query) use ($callsign) {
                $query->where('callsign', $callsign);
            });
        }

        if ($filters->has('member.irma_id')) {
            $callsign = $filters->get('member.irma_id');
            $builder->whereHas('member', function ($query) use ($callsign) {
                $query->where('irma_id', $callsign);
            });
        }

        if ($filters->has('member.id')) {
            $memberId = $filters->get('member.id');
            $builder->whereHas('member', function ($query) use ($memberId) {
                $query->where('id', $memberId);
            });
        }
    }

    /**
     * @param Collection $filters
     * @return bool
     */
    protected function isSearchOne(Collection $filters)
    {
        return false;
    }
}
