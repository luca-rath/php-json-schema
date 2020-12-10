<?php

declare(strict_types=1);

namespace JsonSchema\Tests\Unit\Schema;

use JsonSchema\Property\PropertyInterface;
use JsonSchema\Schema\ObjectSchema;
use JsonSchema\Schema\StringSchema;
use Prophecy\Prophecy\ObjectProphecy;

class ObjectSchemaTest extends AbstractSchemaTest
{
    protected static function getSchemaClass(): string
    {
        return ObjectSchema::class;
    }

    protected static function getBaseJsonSchema(): array
    {
        return [
            'type' => 'object',
        ];
    }

    /**
     * @param string[]|null $dependentRequired
     *
     * @return ObjectProphecy<PropertyInterface>
     */
    private function mockProperty(
        string $name,
        bool $isRequired,
        object $jsonSchema,
        ?array $dependentRequired = null,
        ?object $dependentSchema = null
    ): ObjectProphecy {
        $property = $this->prophesize(PropertyInterface::class);
        $property->getName()->willReturn($name);
        $property->isRequired()->willReturn($isRequired);
        $property->getDependentRequired()->willReturn($dependentRequired);
        $property->getDependentSchema()->willReturn($dependentSchema);
        $property->toJsonSchema()->willReturn($jsonSchema);

        return $property;
    }

    /**
     * @covers \JsonSchema\Schema\ObjectSchema::__construct
     */
    public function testConstruct(): void
    {
        $schema = new ObjectSchema();

        static::assertEquals((object) ['type' => 'object'], $schema->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\ObjectSchema::nullable
     */
    public function testNullable(): void
    {
        $schema1 = new ObjectSchema();
        $schema2 = $schema1->nullable(true);
        $schema3 = $schema1->nullable(false);

        static::assertEquals((object) ['type' => 'object'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => ['object', 'null']], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'object'], $schema3->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\ObjectSchema::properties
     */
    public function testProperties(): void
    {
        $property1 = $this->mockProperty('property1', false, (object) []);
        $property2 = $this->mockProperty('property2', true, (object) []);
        $property3 = $this->mockProperty('property3', false, (object) [], ['property1', 'property2']);
        $property4 = $this->mockProperty('property4', false, (object) [], null, (object) ['foo' => 'bar']);
        $property5 = $this->mockProperty('property5', true, (object) [], ['property4'], (object) ['bar' => 'baz']);

        $schema1 = new ObjectSchema();
        $schema2 = $schema1->properties([$property1->reveal()]);
        $schema3 = $schema2->properties([$property1->reveal(), $property2->reveal()]);
        $schema4 = $schema3->properties([$property1->reveal(), $property2->reveal(), $property3->reveal()]);
        $schema5 = $schema4->properties([$property1->reveal(), $property2->reveal(), $property3->reveal(), $property4->reveal()]);
        $schema6 = $schema5->properties([$property1->reveal(), $property2->reveal(), $property3->reveal(), $property4->reveal(), $property5->reveal()]);
        $schema7 = $schema6->properties(null);

        static::assertEquals((object) ['type' => 'object'], $schema1->toJsonSchema());
        static::assertEquals((object) [
            'type' => 'object',
            'properties' => (object) [
                'property1' => (object) [],
            ],
        ], $schema2->toJsonSchema());
        static::assertEquals((object) [
            'type' => 'object',
            'properties' => (object) [
                'property1' => (object) [],
                'property2' => (object) [],
            ],
            'required' => ['property2'],
        ], $schema3->toJsonSchema());
        static::assertEquals((object) [
            'type' => 'object',
            'properties' => (object) [
                'property1' => (object) [],
                'property2' => (object) [],
                'property3' => (object) [],
            ],
            'required' => ['property2'],
            'dependentRequired' => (object) [
                'property3' => ['property1', 'property2'],
            ],
        ], $schema4->toJsonSchema());
        static::assertEquals((object) [
            'type' => 'object',
            'properties' => (object) [
                'property1' => (object) [],
                'property2' => (object) [],
                'property3' => (object) [],
                'property4' => (object) [],
            ],
            'required' => ['property2'],
            'dependentRequired' => (object) [
                'property3' => ['property1', 'property2'],
            ],
            'dependentSchemas' => (object) [
                'property4' => (object) [
                    'foo' => 'bar',
                ],
            ],
        ], $schema5->toJsonSchema());
        static::assertEquals((object) [
            'type' => 'object',
            'properties' => (object) [
                'property1' => (object) [],
                'property2' => (object) [],
                'property3' => (object) [],
                'property4' => (object) [],
                'property5' => (object) [],
            ],
            'required' => ['property2', 'property5'],
            'dependentRequired' => (object) [
                'property3' => ['property1', 'property2'],
                'property5' => ['property4'],
            ],
            'dependentSchemas' => (object) [
                'property4' => (object) ['foo' => 'bar'],
                'property5' => (object) ['bar' => 'baz'],
            ],
        ], $schema6->toJsonSchema());
        static::assertEquals((object) ['type' => 'object'], $schema7->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\ObjectSchema::additionalProperties
     */
    public function testAdditionalProperties(): void
    {
        $additionalPropertiesJsonSchema = (object) ['foo' => 'bar'];
        $additionalPropertiesSchema = $this->mockSchema($additionalPropertiesJsonSchema);

        $schema1 = new ObjectSchema();
        $schema2 = $schema1->additionalProperties($additionalPropertiesSchema->reveal());
        $schema3 = $schema2->additionalProperties(true);
        $schema4 = $schema3->additionalProperties(false);
        $schema5 = $schema4->additionalProperties(null);

        static::assertEquals((object) ['type' => 'object'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'object', 'additionalProperties' => $additionalPropertiesJsonSchema], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'object', 'additionalProperties' => true], $schema3->toJsonSchema());
        static::assertEquals((object) ['type' => 'object', 'additionalProperties' => false], $schema4->toJsonSchema());
        static::assertEquals((object) ['type' => 'object'], $schema5->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\ObjectSchema::minProperties
     */
    public function testMinProperties(): void
    {
        $schema1 = new ObjectSchema();
        $schema2 = $schema1->minProperties(3);
        $schema3 = $schema2->minProperties(null);

        static::assertEquals((object) ['type' => 'object'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'object', 'minProperties' => 3], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'object'], $schema3->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\ObjectSchema::maxProperties
     */
    public function testMaxProperties(): void
    {
        $schema1 = new ObjectSchema();
        $schema2 = $schema1->maxProperties(3);
        $schema3 = $schema2->maxProperties(null);

        static::assertEquals((object) ['type' => 'object'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'object', 'maxProperties' => 3], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'object'], $schema3->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\ObjectSchema::propertyNames
     */
    public function testPropertyNames(): void
    {
        $propertyNamesJsonSchema = (object) ['type' => 'string', 'foo' => 'bar'];
        $propertyNamesSchema = $this->prophesize(StringSchema::class);
        $propertyNamesSchema->toJsonSchema()->willReturn($propertyNamesJsonSchema);

        $schema1 = new ObjectSchema();
        $schema2 = $schema1->propertyNames($propertyNamesSchema->reveal());
        $schema3 = $schema2->propertyNames(null);

        static::assertEquals((object) ['type' => 'object'], $schema1->toJsonSchema());
        static::assertEquals((object) ['type' => 'object', 'propertyNames' => $propertyNamesJsonSchema], $schema2->toJsonSchema());
        static::assertEquals((object) ['type' => 'object'], $schema3->toJsonSchema());
    }
}
