<?php

declare(strict_types=1);

namespace JsonSchema\Property;

use JsonSchema\Schema\SchemaInterface;
use Webmozart\Assert\Assert;

class Property implements PropertyInterface
{
    private string $name;
    private bool $required;
    private SchemaInterface $schema;

    /**
     * @var string[]|null
     */
    private ?array $dependentRequired = null;
    private ?SchemaInterface $dependentSchema = null;

    public function __construct(string $name, bool $required, SchemaInterface $schema)
    {
        $this->name = $name;
        $this->required = $required;
        $this->schema = $schema;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @return string[]|null
     */
    public function getDependentRequired(): ?array
    {
        return $this->dependentRequired;
    }

    public function getDependentSchema(): ?object
    {
        if (null === $this->dependentSchema) {
            return null;
        }

        return $this->dependentSchema->toJsonSchema();
    }

    public function name(string $name): self
    {
        $instance = clone $this;
        $instance->name = $name;

        return $instance;
    }

    public function required(bool $required): self
    {
        $instance = clone $this;
        $instance->required = $required;

        return $instance;
    }

    public function schema(SchemaInterface $schema): self
    {
        $instance = clone $this;
        $instance->schema = $schema;

        return $instance;
    }

    /**
     * @param string[]|null $dependentRequired
     */
    public function dependentRequired(?array $dependentRequired): self
    {
        if (null !== $dependentRequired) {
            Assert::isNonEmptyList($dependentRequired);
            Assert::uniqueValues($dependentRequired);
            Assert::allStringNotEmpty($dependentRequired);
        }

        $instance = clone $this;
        $instance->dependentRequired = $dependentRequired;

        return $instance;
    }

    public function dependentSchema(?SchemaInterface $dependentSchema): self
    {
        $instance = clone $this;
        $instance->dependentSchema = $dependentSchema;

        return $instance;
    }

    public function toJsonSchema(): object
    {
        return $this->schema->toJsonSchema();
    }

    /**
     * @return static
     */
    public static function create(string $name, bool $required, SchemaInterface $schema): self
    {
        return new static($name, $required, $schema);
    }
}
