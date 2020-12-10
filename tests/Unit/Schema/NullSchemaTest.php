<?php

declare(strict_types=1);

namespace JsonSchema\Tests\Unit\Schema;

use JsonSchema\Schema\NullSchema;

class NullSchemaTest extends AbstractSchemaTest
{
    protected static function getSchemaClass(): string
    {
        return NullSchema::class;
    }

    protected static function getBaseJsonSchema(): array
    {
        return [
            'type' => 'null',
        ];
    }

    /**
     * @covers \JsonSchema\Schema\NullSchema::__construct
     */
    public function testConstruct(): void
    {
        $schema = new NullSchema();

        static::assertEquals((object) ['type' => 'null'], $schema->toJsonSchema());
    }
}
