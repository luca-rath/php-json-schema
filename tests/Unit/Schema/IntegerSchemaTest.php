<?php

declare(strict_types=1);

namespace JsonSchema\Tests\Unit\Schema;

use JsonSchema\Schema\IntegerSchema;

class IntegerSchemaTest extends AbstractSchemaTest
{
    protected static function getSchemaClass(): string
    {
        return IntegerSchema::class;
    }

    protected static function getBaseJsonSchema(): array
    {
        return [
            'type' => 'integer',
        ];
    }

    public function testConstruct(): void
    {
        $schema = new IntegerSchema();

        static::assertEquals((object) ['type' => 'integer'], $schema->toJsonSchema());
    }

    public function testNullable(): void
    {
        $schema1 = new IntegerSchema();
        $schema2 = $schema1->nullable(true);
        $schema3 = $schema1->nullable(false);

        static::assertEquals((object) ['type' => 'integer'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => ['integer', 'null']], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'integer'], $schema3->toJsonSchema());
    }

    public function testMinimum(): void
    {
        $schema1 = new IntegerSchema();
        $schema2 = $schema1->minimum(3);
        $schema3 = $schema2->minimum(null);

        static::assertEquals((object) ['type' => 'integer'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'integer', 'minimum' => 3], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'integer'], $schema3->toJsonSchema());
    }

    public function testMaximum(): void
    {
        $schema1 = new IntegerSchema();
        $schema2 = $schema1->maximum(3);
        $schema3 = $schema2->maximum(null);

        static::assertEquals((object) ['type' => 'integer'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'integer', 'maximum' => 3], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'integer'], $schema3->toJsonSchema());
    }

    public function testExclusiveMinimum(): void
    {
        $schema1 = new IntegerSchema();
        $schema2 = $schema1->exclusiveMinimum(3);
        $schema3 = $schema2->exclusiveMinimum(null);

        static::assertEquals((object) ['type' => 'integer'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'integer', 'exclusiveMinimum' => 3], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'integer'], $schema3->toJsonSchema());
    }

    public function testExclusiveMaximum(): void
    {
        $schema1 = new IntegerSchema();
        $schema2 = $schema1->exclusiveMaximum(3);
        $schema3 = $schema2->exclusiveMaximum(null);

        static::assertEquals((object) ['type' => 'integer'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'integer', 'exclusiveMaximum' => 3], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'integer'], $schema3->toJsonSchema());
    }

    public function testMultipleOf(): void
    {
        $schema1 = new IntegerSchema();
        $schema2 = $schema1->multipleOf(3);
        $schema3 = $schema2->multipleOf(null);

        static::assertEquals((object) ['type' => 'integer'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'integer', 'multipleOf' => 3], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'integer'], $schema3->toJsonSchema());
    }
}
