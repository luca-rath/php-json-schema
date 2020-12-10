<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use JsonSchema\Property\PropertyInterface;
use Webmozart\Assert\Assert;

class RequiredKeyword extends AbstractKeyword
{
    const NAME = 'required';

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

        $required = array_values(
            array_map(
                function (PropertyInterface $property): string {
                    return $property->getName();
                },
                array_filter(
                    $properties,
                    function (PropertyInterface $property): bool {
                        return $property->isRequired();
                    }
                )
            )
        );

        if (0 === \count($required)) {
            parent::__construct(static::NAME, null);

            return;
        }

        parent::__construct(static::NAME, $required);
    }
}
