<?php

declare(strict_types=1);

namespace JsonSchema\Property;

use JsonSchema\Schema\SchemaInterface;

interface PropertyInterface
{
    public function __construct(string $name, bool $required, SchemaInterface $schema);

    public function getName(): string;

    public function isRequired(): bool;

    /**
     * @return string[]|null
     */
    public function getDependentRequired(): ?array;

    public function getDependentSchema(): ?object;

    public function toJsonSchema(): object;

    /**
     * @return static
     */
    public static function create(string $name, bool $required, SchemaInterface $schema): self;
}
