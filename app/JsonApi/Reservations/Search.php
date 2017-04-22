<?php

namespace Irma\JsonApi\Reservations;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use CloudCreativity\LaravelJsonApi\Search\AbstractSearch;
use Irma\JsonApi\Contracts\ModifiableAttributeCollection;
use Irma\JsonApi\ModifiableCarbonAttribute;
use Irma\JsonApi\ModifiableFilters;

class Search extends AbstractSearch
{
    use ModifiableFilters;

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
        if ($filters->has('aircraft.callsign')) {
            $callsign = $filters->get('aircraft.callsign');
            $builder->whereHas('aircraft', function (Builder $query) use ($callsign) {
                $query->where('callsign', $callsign);
            });
        }

        if ($filters->has('member.irma_id')) {
            $callsign = $filters->get('member.irma_id');
            $builder->whereHas('member', function (Builder $query) use ($callsign) {
                $query->where('irma_id', $callsign);
            });
        }

        if ($filters->has('member.id')) {
            $memberId = $filters->get('member.id');
            $builder->whereHas('member', function (Builder $query) use ($memberId) {
                $query->where('id', $memberId);
            });
        }

        $this->filterWithModifiers($builder, $filters);
    }

    /**
     * @return ModifiableAttributeCollection
     */
    protected function getModifiableAttributes() : ModifiableAttributeCollection
    {
        return \Irma\JsonApi\ModifiableAttributeCollection::create([
            ModifiableCarbonAttribute::create('start'),
            ModifiableCarbonAttribute::create('end'),
        ]);
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
