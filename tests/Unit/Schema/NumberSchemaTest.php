<?php

declare(strict_types=1);

namespace JsonSchema\Tests\Unit\Schema;

use JsonSchema\Schema\NumberSchema;

class NumberSchemaTest extends AbstractSchemaTest
{
    protected static function getSchemaClass(): string
    {
        return NumberSchema::class;
    }

    protected static function getBaseJsonSchema(): array
    {
        return [
            'type' => 'number',
        ];
    }

    /**
     * @covers \JsonSchema\Schema\NumberSchema::__construct
     */
    public function testConstruct(): void
    {
        $schema = new NumberSchema();

        static::assertEquals((object) ['type' => 'number'], $schema->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\NumberSchema::nullable
     */
    public function testNullable(): void
    {
        $schema1 = new NumberSchema();
        $schema2 = $schema1->nullable(true);
        $schema3 = $schema1->nullable(false);

        static::assertEquals((object) ['type' => 'number'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => ['number', 'null']], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'number'], $schema3->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\NumberSchema::minimum
     */
    public function testMinimum(): void
    {
        $schema1 = new NumberSchema();
        $schema2 = $schema1->minimum(3);
        $schema3 = $schema1->minimum(2.5);
        $schema4 = $schema2->minimum(null);

        static::assertEquals((object) ['type' => 'number'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'number', 'minimum' => 3], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'number', 'minimum' => 2.5], $schema3->toJsonSchema());
        static::assertEquals((object) ['type' => 'number'], $schema4->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\NumberSchema::maximum
     */
    public function testMaximum(): void
    {
        $schema1 = new NumberSchema();
        $schema2 = $schema1->maximum(3);
        $schema3 = $schema1->maximum(2.5);
        $schema4 = $schema2->maximum(null);

        static::assertEquals((object) ['type' => 'number'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'number', 'maximum' => 3], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'number', 'maximum' => 2.5], $schema3->toJsonSchema());
        static::assertEquals((object) ['type' => 'number'], $schema4->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\NumberSchema::exclusiveMinimum
     */
    public function testExclusiveMinimum(): void
    {
        $schema1 = new NumberSchema();
        $schema2 = $schema1->exclusiveMinimum(3);
        $schema3 = $schema1->exclusiveMinimum(2.5);
        $schema4 = $schema2->exclusiveMinimum(null);

        static::assertEquals((object) ['type' => 'number'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'number', 'exclusiveMinimum' => 3], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'number', 'exclusiveMinimum' => 2.5], $schema3->toJsonSchema());
        static::assertEquals((object) ['type' => 'number'], $schema4->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\NumberSchema::exclusiveMaximum
     */
    public function testExclusiveMaximum(): void
    {
        $schema1 = new NumberSchema();
        $schema2 = $schema1->exclusiveMaximum(3);
        $schema3 = $schema1->exclusiveMaximum(2.5);
        $schema4 = $schema2->exclusiveMaximum(null);

        static::assertEquals((object) ['type' => 'number'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'number', 'exclusiveMaximum' => 3], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'number', 'exclusiveMaximum' => 2.5], $schema3->toJsonSchema());
        static::assertEquals((object) ['type' => 'number'], $schema4->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\NumberSchema::multipleOf
     */
    public function testMultipleOf(): void
    {
        $schema1 = new NumberSchema();
        $schema2 = $schema1->multipleOf(3);
        $schema3 = $schema1->multipleOf(2.5);
        $schema4 = $schema2->multipleOf(null);

        static::assertEquals((object) ['type' => 'number'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'number', 'multipleOf' => 3], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'number', 'multipleOf' => 2.5], $schema3->toJsonSchema());
        static::assertEquals((object) ['type' => 'number'], $schema4->toJsonSchema());
    }
}
