<?php

declare(strict_types=1);

namespace JsonSchema\Tests\Unit\Schema;

use JsonSchema\Schema\ArraySchema;

class ArraySchemaTest extends AbstractSchemaTest
{
    protected static function getSchemaClass(): string
    {
        return ArraySchema::class;
    }

    protected static function getBaseJsonSchema(): array
    {
        return [
            'type' => 'array',
        ];
    }

    /**
     * @covers \JsonSchema\Schema\ArraySchema::__construct
     */
    public function testConstruct(): void
    {
        $schema = new ArraySchema();

        static::assertEquals((object) ['type' => 'array'], $schema->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\ArraySchema::nullable
     */
    public function testNullable(): void
    {
        $schema1 = new ArraySchema();
        $schema2 = $schema1->nullable(true);
        $schema3 = $schema1->nullable(false);

        static::assertEquals((object) ['type' => 'array'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => ['array', 'null']], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'array'], $schema3->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\ArraySchema::items
     */
    public function testItems(): void
    {
        $itemsJsonSchema1 = (object) ['foo' => 'bar'];
        $itemsSchema1 = $this->mockSchema($itemsJsonSchema1);

        $itemsJsonSchema2 = (object) ['bar' => 'baz'];
        $itemsSchema2 = $this->mockSchema($itemsJsonSchema2);

        $schema1 = new ArraySchema();
        $schema2 = $schema1->items($itemsSchema1->reveal());
        $schema3 = $schema2->items([$itemsSchema1->reveal(), $itemsSchema2->reveal()]);
        $schema4 = $schema3->items(null);

        static::assertEquals((object) ['type' => 'array'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'array', 'items' => $itemsJsonSchema1], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'array', 'items' => [
            $itemsJsonSchema1,
            $itemsJsonSchema2,
        ]], $schema3->toJsonSchema());
        static::assertEquals((object) ['type' => 'array'], $schema4->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\ArraySchema::contains
     */
    public function testContains(): void
    {
        $containsJsonSchema = (object) ['foo' => 'bar'];
        $containsSchema = $this->mockSchema($containsJsonSchema);

        $schema1 = new ArraySchema();
        $schema2 = $schema1->contains($containsSchema->reveal());
        $schema3 = $schema2->contains(null);

        static::assertEquals((object) ['type' => 'array'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'array', 'contains' => $containsJsonSchema], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'array'], $schema3->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\ArraySchema::additionalItems
     */
    public function testAdditionalItems(): void
    {
        $additionalItemsJsonSchema = (object) ['foo' => 'bar'];
        $additionalItemsSchema = $this->mockSchema($additionalItemsJsonSchema);

        $schema1 = new ArraySchema();
        $schema2 = $schema1->additionalItems($additionalItemsSchema->reveal());
        $schema3 = $schema2->additionalItems(true);
        $schema4 = $schema3->additionalItems(false);
        $schema5 = $schema4->additionalItems(null);

        static::assertEquals((object) ['type' => 'array'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'array', 'additionalItems' => $additionalItemsJsonSchema], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'array', 'additionalItems' => true], $schema3->toJsonSchema());
        static::assertEquals((object) ['type' => 'array', 'additionalItems' => false], $schema4->toJsonSchema());
        static::assertEquals((object) ['type' => 'array'], $schema5->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\ArraySchema::minItems
     */
    public function testMinItems(): void
    {
        $schema1 = new ArraySchema();
        $schema2 = $schema1->minItems(3);
        $schema3 = $schema2->minItems(null);

        static::assertEquals((object) ['type' => 'array'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'array', 'minItems' => 3], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'array'], $schema3->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\ArraySchema::maxItems
     */
    public function testMaxItems(): void
    {
        $schema1 = new ArraySchema();
        $schema2 = $schema1->maxItems(3);
        $schema3 = $schema2->maxItems(null);

        static::assertEquals((object) ['type' => 'array'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'array', 'maxItems' => 3], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'array'], $schema3->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\ArraySchema::minContains
     */
    public function testMinContains(): void
    {
        $schema1 = new ArraySchema();
        $schema2 = $schema1->minContains(3);
        $schema3 = $schema2->minContains(null);

        static::assertEquals((object) ['type' => 'array'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'array', 'minContains' => 3], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'array'], $schema3->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\ArraySchema::maxContains
     */
    public function testMaxContains(): void
    {
        $schema1 = new ArraySchema();
        $schema2 = $schema1->maxContains(3);
        $schema3 = $schema2->maxContains(null);

        static::assertEquals((object) ['type' => 'array'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'array', 'maxContains' => 3], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'array'], $schema3->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\ArraySchema::uniqueItems
     */
    public function testUniqueItems(): void
    {
        $schema1 = new ArraySchema();
        $schema2 = $schema1->uniqueItems(true);
        $schema3 = $schema2->uniqueItems(false);
        $schema4 = $schema3->uniqueItems(null);

        static::assertEquals((object) ['type' => 'array'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'array', 'uniqueItems' => true], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'array', 'uniqueItems' => false], $schema3->toJsonSchema());
        static::assertEquals((object) ['type' => 'array'], $schema4->toJsonSchema());
    }
}
