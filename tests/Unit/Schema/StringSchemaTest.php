<?php

declare(strict_types=1);

namespace JsonSchema\Tests\Unit\Schema;

use JsonSchema\Keyword\FormatKeyword;
use JsonSchema\Schema\StringSchema;

class StringSchemaTest extends AbstractSchemaTest
{
    protected static function getSchemaClass(): string
    {
        return StringSchema::class;
    }

    protected static function getBaseJsonSchema(): array
    {
        return [
            'type' => 'string',
        ];
    }

    public function testConstruct(): void
    {
        $schema = new StringSchema();

        static::assertEquals((object) ['type' => 'string'], $schema->toJsonSchema());
    }

    public function testNullable(): void
    {
        $schema1 = new StringSchema();
        $schema2 = $schema1->nullable(true);
        $schema3 = $schema1->nullable(false);

        static::assertEquals((object) ['type' => 'string'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => ['string', 'null']], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'string'], $schema3->toJsonSchema());
    }

    public function testMinLength(): void
    {
        $schema1 = new StringSchema();
        $schema2 = $schema1->minLength(3);
        $schema3 = $schema2->minLength(null);

        static::assertEquals((object) ['type' => 'string'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'string', 'minLength' => 3], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'string'], $schema3->toJsonSchema());
    }

    public function testMaxLength(): void
    {
        $schema1 = new StringSchema();
        $schema2 = $schema1->maxLength(3);
        $schema3 = $schema2->maxLength(null);

        static::assertEquals((object) ['type' => 'string'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'string', 'maxLength' => 3], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'string'], $schema3->toJsonSchema());
    }

    public function testPattern(): void
    {
        $schema1 = new StringSchema();
        $schema2 = $schema1->pattern('^foo$');
        $schema3 = $schema2->pattern(null);

        static::assertEquals((object) ['type' => 'string'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'string', 'pattern' => '^foo$'], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'string'], $schema3->toJsonSchema());
    }

    public function testFormat(): void
    {
        $schema1 = new StringSchema();
        $schema2 = $schema1->format(FormatKeyword::FORMAT_UUID);
        $schema3 = $schema2->format('custom');
        $schema4 = $schema3->format(null);

        static::assertEquals((object) ['type' => 'string'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'string', 'format' => FormatKeyword::FORMAT_UUID], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'string', 'format' => 'custom'], $schema3->toJsonSchema());
        static::assertEquals((object) ['type' => 'string'], $schema4->toJsonSchema());
    }
}
