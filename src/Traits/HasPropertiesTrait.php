<?php

namespace WikibaseSolutions\CypherDSL\Traits;

use function is_array;
use WikibaseSolutions\CypherDSL\PropertyMap;
use WikibaseSolutions\CypherDSL\Types\AnyType;
use WikibaseSolutions\CypherDSL\Types\StructuralTypes\HasPropertiesType;

trait HasPropertiesTrait
{
    use ErrorTrait;

    private ?PropertyMap $properties = null;

    /**
     * Add the given property to the properties of this node.
     *
     * @param string $key The name of the property
     * @param AnyType $value The value of the property
     *
     * @return HasPropertiesType
     */
    public function withProperty(string $key, AnyType $value): HasPropertiesType
    {
        $this->initialiseProperties();

        $this->properties->addProperty($key, $value);

        return $this;
    }

    /**
     * Add the given properties to the properties of this node.
     *
     * @param PropertyMap|array $properties
     *
     * @return HasPropertiesType
     */
    public function withProperties($properties): HasPropertiesType
    {
        self::assertClass('properties', [PropertyMap::class, 'array'], $properties);

        $this->initialiseProperties();

        $properties = is_array($properties) ? new PropertyMap($properties) : $properties;

        $this->properties->mergeWith($properties);

        return $this;
    }

    public function getProperties(): ?PropertyMap
    {
        return $this->properties;
    }

    /**
     * @return void
     */
    private function initialiseProperties(): void
    {
        if ($this->properties === null) {
            $this->properties = new PropertyMap();
        }
    }
}
