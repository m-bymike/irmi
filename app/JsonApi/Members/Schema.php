<?php

namespace Irma\JsonApi\Members;

use Irma\Member;
use Irma\JsonApi\AbstractSchema;

class Schema extends AbstractSchema
{

    /**
     * @var string
     */
    const RESOURCE_TYPE = 'members';

    /**
     * @var array|null
     */
    protected $attributes = null;

    /**
     * @return string
     */
    public function getResourceType()
    {
        return self::RESOURCE_TYPE;
    }

    /**
     * @param Member $resource
     * @param bool   $isPrimary
     * @param array  $includeRelationships
     *
     * @return array
     */
    public function getRelationships($resource, $isPrimary, array $includeRelationships) : array
    {
        $relationships = [];

        foreach ($includeRelationships as $relationship) {
            $relationships[$relationship] = $this->getRelationship($resource, $relationship);
        }

        return $relationships;
    }

    /**
     * @param Member $member
     * @param string $relationship
     *
     * @return array
     */
    public function getRelationship(Member $member, string $relationship) : array
    {
        switch ($relationship) {
            case 'reservations':
                return $this->makeRelationshipArray($member->reservations);
        }

        throw new \InvalidArgumentException();
    }
}

