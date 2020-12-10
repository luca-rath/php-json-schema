<?php

namespace JsonSchema\Keyword;

use JsonSchema\Property\PropertyInterface;
use Webmozart\Assert\Assert;

class PropertiesKeyword extends AbstractKeyword
{
    const NAME = 'properties';

    /**
     * @param PropertyInterface[]|null $properties
     */
    public function __construct(?array $properties)
    {
        if (null === $properties) {
            parent::__construct(static::NAME, null);

            return;
        }

        Assert::isNonEmptyList($properties);
        Assert::allIsInstanceOf($properties, PropertyInterface::class);

        $propertiesValue = [];

        foreach ($properties as $property) {
            $propertiesValue[$property->getName()] = $property->toJsonSchema();
        }

        parent::__construct(static::NAME, (object) $propertiesValue);
    }
}
