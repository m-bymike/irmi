<?php

namespace Irma\JsonApi\Reservations;

use Irma\Reservation;
use Irma\JsonApi\AbstractSchema;

class Schema extends AbstractSchema
{

    /**
     * @var string
     */
    const RESOURCE_TYPE = 'reservations';

    /**
     * @var array|null
     */
    protected $attributes = [

        'start' => 'start',
        'end' => 'end',
        'type' => 'reservation_type',
    ];

    /**
     * @return string
     */
    public function getResourceType()
    {
        return self::RESOURCE_TYPE;
    }

    /**
     * @param Reservation $resource
     * @param bool        $isPrimary
     * @param array       $includeRelationships
     *
     * @return array
     */
    public function getRelationships($resource, $isPrimary, array $includeRelationships)
    {
        $relationships = [];
        foreach ($includeRelationships as $includeRelationship) {
            $relationships[$includeRelationship] = $this->getRelationship($resource, $includeRelationship);
        }

        return $relationships;
    }

    /**
     * @param Reservation $resource
     * @param string      $relationship
     *
     * @return array
     */
    public function getRelationship(Reservation $resource, string $relationship) : array
    {
        switch ($relationship) {
            case 'aircraft':
                return $this->makeRelationshipArray($resource->aircraft);

            case 'member':
                return $this->makeRelationshipArray($resource->member);

        }

        throw new \InvalidArgumentException();
    }
}

