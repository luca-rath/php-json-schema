<?php

namespace JsonSchema\Schema;

use JsonSchema\Keyword\AdditionalPropertiesKeyword;
use JsonSchema\Keyword\DependentRequiredKeyword;
use JsonSchema\Keyword\DependentSchemasKeyword;
use JsonSchema\Keyword\MaxPropertiesKeyword;
use JsonSchema\Keyword\MinPropertiesKeyword;
use JsonSchema\Keyword\PropertiesKeyword;
use JsonSchema\Keyword\PropertyNamesKeyword;
use JsonSchema\Keyword\RequiredKeyword;
use JsonSchema\Keyword\TypeKeyword;
use JsonSchema\Keyword\UnevaluatedPropertiesKeyword;
use JsonSchema\Property\PropertyInterface;

class ObjectSchema extends AbstractSchema
{
    public function __construct()
    {
        parent::__construct(
            new TypeKeyword('object')
        );
    }

    /**
     * @return static
     */
    public function nullable(bool $nullable = true): self
    {
        if (!$nullable) {
            return $this->with(
                new TypeKeyword('object')
            );
        }

        return $this->with(
            new TypeKeyword(['object', 'null'])
        );
    }

    /**
     * @param PropertyInterface[]|null $properties
     *
     * @return static
     */
    public function properties(?array $properties): self
    {
        return $this
            ->with(new PropertiesKeyword($properties))
            ->with(new RequiredKeyword($properties))
            ->with(new DependentRequiredKeyword($properties))
            ->with(new DependentSchemasKeyword($properties));
    }

    /**
     * @param bool|SchemaInterface|null $additionalProperties
     *
     * @return static
     */
    public function additionalProperties($additionalProperties): self
    {
        return $this->with(
            new AdditionalPropertiesKeyword($additionalProperties)
        );
    }

    /**
     * @param bool|SchemaInterface|null $unevaluatedProperties
     *
     * @return static
     */
    public function unevaluatedProperties($unevaluatedProperties): self
    {
        return $this->with(
            new UnevaluatedPropertiesKeyword($unevaluatedProperties)
        );
    }

    /**
     * @return static
     */
    public function minProperties(?int $minProperties): self
    {
        return $this->with(
            new MinPropertiesKeyword($minProperties)
        );
    }

    /**
     * @return static
     */
    public function maxProperties(?int $maxProperties): self
    {
        return $this->with(
            new MaxPropertiesKeyword($maxProperties)
        );
    }

    /**
     * @return static
     */
    public function propertyNames(?StringSchema $propertyNames): self
    {
        return $this->with(
            new PropertyNamesKeyword($propertyNames)
        );
    }
}
