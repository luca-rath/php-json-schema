<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use JsonSchema\Property\PropertyInterface;
use Webmozart\Assert\Assert;

class DependentRequiredKeyword extends AbstractKeyword
{
    const NAME = 'dependentRequired';

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

        $dependentRequired = [];

        foreach ($properties as $property) {
            $propertyDependentRequired = $property->getDependentRequired();

            if (null !== $propertyDependentRequired) {
                $dependentRequired[$property->getName()] = $propertyDependentRequired;
            }
        }

        if (0 === \count($dependentRequired)) {
            parent::__construct(static::NAME, null);

            return;
        }

        parent::__construct(static::NAME, (object) $dependentRequired);
    }
}
