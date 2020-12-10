<?php

declare(strict_types=1);

namespace JsonSchema\Tests\Unit\Property;

use JsonSchema\Property\Property;
use JsonSchema\Schema\SchemaInterface;
use JsonSchema\Tests\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

class PropertyTest extends TestCase
{
    /**
     * @return ObjectProphecy<SchemaInterface>
     */
    private function mockSchema(object $jsonSchema = null): ObjectProphecy
    {
        $schema = $this->prophesize(SchemaInterface::class);
        $schema->toJsonSchema()->willReturn($jsonSchema ?? (object) []);

        return $schema;
    }

    public function testConstruct(): void
    {
        $jsonSchema = (object) [];
        $schema = $this->mockSchema($jsonSchema);
        $property = new Property('name', true, $schema->reveal());

        static::assertSame('name', $property->getName());
        static::assertTrue($property->isRequired());
        static::assertSame($jsonSchema, $property->toJsonSchema());
    }

    public function testCreate(): void
    {
        $jsonSchema = (object) [];
        $schema = $this->mockSchema($jsonSchema);
        $property = Property::create('name', false, $schema->reveal());

        static::assertSame('name', $property->getName());
        static::assertFalse($property->isRequired());
        static::assertSame($jsonSchema, $property->toJsonSchema());
    }

    public function testName(): void
    {
        $schema = $this->mockSchema();
        $property1 = new Property('name', false, $schema->reveal());
        $property2 = $property1->name('another-name');

        static::assertNotSame($property1, $property2);
        static::assertSame('name', $property1->getName());
        static::assertSame('another-name', $property2->getName());
    }

    public function testRequired(): void
    {
        $schema = $this->mockSchema();
        $property1 = new Property('name', false, $schema->reveal());
        $property2 = $property1->required(true);

        static::assertNotSame($property1, $property2);
        static::assertFalse($property1->isRequired());
        static::assertTrue($property2->isRequired());
    }

    public function testSchema(): void
    {
        $jsonSchema1 = (object) [];
        $schema1 = $this->mockSchema($jsonSchema1);
        $property1 = new Property('name', false, $schema1->reveal());

        $jsonSchema2 = (object) [];
        $schema2 = $this->mockSchema($jsonSchema2);
        $property2 = $property1->schema($schema2->reveal());

        static::assertNotSame($property1, $property2);
        static::assertSame($jsonSchema1, $property1->toJsonSchema());
        static::assertSame($jsonSchema2, $property2->toJsonSchema());
    }

    public function testDependentRequired(): void
    {
        $schema = $this->mockSchema();
        $property1 = new Property('name', false, $schema->reveal());
        $property2 = $property1->dependentRequired(['foo', 'bar']);

        static::assertNotSame($property1, $property2);
        static::assertNull($property1->getDependentRequired());
        static::assertSame(['foo', 'bar'], $property2->getDependentRequired());
    }

    public function testDependentRequiredWithEmptyArray(): void
    {
        $schema = $this->mockSchema();
        $property = new Property('name', false, $schema->reveal());

        static::expectExceptionMessage('Expected a non-empty value. Got: array');

        $property->dependentRequired([]);
    }

    public function testDependentRequiredWithMap(): void
    {
        $schema = $this->mockSchema();
        $property = new Property('name', false, $schema->reveal());

        static::expectExceptionMessage('Expected list - non-associative array.');

        $property->dependentRequired(['foo' => 'bar', 'bar' => 'baz']);
    }

    public function testDependentRequiredWithNonUniqueValues(): void
    {
        $schema = $this->mockSchema();
        $property = new Property('name', false, $schema->reveal());

        static::expectExceptionMessage('Expected an array of unique values, but 1 of them is duplicated');

        $property->dependentRequired(['foo', 'foo']);
    }

    public function testDependentRequiredWithEmptyString(): void
    {
        $schema = $this->mockSchema();
        $property = new Property('name', false, $schema->reveal());

        static::expectExceptionMessage('Expected a different value than "".');

        $property->dependentRequired(['foo', '']);
    }

    public function testDependentSchema(): void
    {
        $schema1 = $this->mockSchema();
        $property1 = new Property('name', false, $schema1->reveal());

        $jsonSchema2 = (object) [];
        $schema2 = $this->mockSchema($jsonSchema2);
        $property2 = $property1->dependentSchema($schema2->reveal());

        static::assertNotSame($property1, $property2);
        static::assertNull($property1->getDependentSchema());
        static::assertSame($jsonSchema2, $property2->getDependentSchema());
    }

    public function testToJsonSchema(): void
    {
        $jsonSchema = (object) [];
        $schema = $this->mockSchema($jsonSchema);
        $property = new Property('name', false, $schema->reveal());

        static::assertSame($jsonSchema, $property->toJsonSchema());
    }
}
