<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use JsonSchema\Property\PropertyInterface;
use Webmozart\Assert\Assert;

class DependentSchemasKeyword extends AbstractKeyword
{
    const NAME = 'dependentSchemas';

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

        $dependentSchemas = [];

        foreach ($properties as $property) {
            $propertyDependentSchema = $property->getDependentSchema();

            if (null !== $propertyDependentSchema) {
                $dependentSchemas[$property->getName()] = $propertyDependentSchema;
            }
        }

        if (0 === \count($dependentSchemas)) {
            parent::__construct(static::NAME, null);

            return;
        }

        parent::__construct(static::NAME, (object) $dependentSchemas);
    }
}
