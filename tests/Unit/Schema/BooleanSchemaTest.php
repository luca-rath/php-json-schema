<?php

declare(strict_types=1);

namespace JsonSchema\Tests\Unit\Schema;

use JsonSchema\Schema\BooleanSchema;

class BooleanSchemaTest extends AbstractSchemaTest
{
    protected static function getSchemaClass(): string
    {
        return BooleanSchema::class;
    }

    protected static function getBaseJsonSchema(): array
    {
        return [
            'type' => 'boolean',
        ];
    }

    public function testConstruct(): void
    {
        $schema = new BooleanSchema();

        static::assertEquals((object) ['type' => 'boolean'], $schema->toJsonSchema());
    }

    public function testNullable(): void
    {
        $schema1 = new BooleanSchema();
        $schema2 = $schema1->nullable(true);
        $schema3 = $schema1->nullable(false);

        static::assertEquals((object) ['type' => 'boolean'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => ['boolean', 'null']], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'boolean'], $schema3->toJsonSchema());
    }
}
