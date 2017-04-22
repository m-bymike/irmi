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

use Irma\JsonApi\Contracts\ModifiableAttribute;
use Irma\JsonApi\Contracts\ModifiableAttributeCollection as ModifiableAttributeCollectionContract;

class ModifiableAttributeCollection implements ModifiableAttributeCollectionContract
{
    /**
     * @var array
     */
    private $list;

    /**
     * @param array $list
     *
     * @return static
     */
    public static function create(array $list = [])
    {
        return new static($list);
    }

    /**
     * ModifiableAttributeCollection constructor.
     *
     * @param array $list
     */
    public function __construct(array $list = [])
    {
        foreach ($list as $item) {
            $this->add($item);
        }
    }

    /**
     * @param ModifiableAttribute $attribute
     *
     * @return ModifiableAttributeCollectionContract
     */
    public function add(ModifiableAttribute $attribute): ModifiableAttributeCollectionContract
    {
        $this->list[] = $attribute;

        return $this;
    }

    /**
     * @return array
     */
    public function all() : array
    {
        return $this->list;
    }
}
