<?php

declare(strict_types=1);

namespace JsonSchema\Tests\Unit\Schema;

use JsonSchema\Schema\Schema;

class SchemaTest extends AbstractSchemaTest
{
    protected static function getSchemaClass(): string
    {
        return Schema::class;
    }

    protected static function getBaseJsonSchema(): array
    {
        return [];
    }

    /**
     * @covers \JsonSchema\Schema\Schema::__construct
     */
    public function testConstruct(): void
    {
        $schema = new Schema();

        static::assertEmpty((array) $schema->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\Schema::type
     */
    public function testType(): void
    {
        $schema1 = Schema::create();
        $schema2 = $schema1->type('foo');
        $schema3 = $schema2->type(['foo']);
        $schema4 = $schema3->type(['foo', 'bar']);
        $schema5 = $schema4->type(null);

        static::assertEquals((object) [], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'foo'], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => ['foo']], $schema3->toJsonSchema());
        static::assertEquals((object) ['type' => ['foo', 'bar']], $schema4->toJsonSchema());
        static::assertEquals((object) [], $schema5->toJsonSchema());
    }
}
