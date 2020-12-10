<?php

declare(strict_types=1);

namespace JsonSchema\Tests\Unit\Schema;

use JsonSchema\Keyword\KeywordInterface;
use JsonSchema\Schema\AbstractSchema;
use JsonSchema\Schema\SchemaInterface;
use JsonSchema\Tests\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

abstract class AbstractSchemaTest extends TestCase
{
    /**
     * @return class-string<AbstractSchema>
     */
    abstract protected static function getSchemaClass(): string;

    /**
     * @return array<string, mixed>
     */
    abstract protected static function getBaseJsonSchema(): array;

    protected static function createSchema(): AbstractSchema
    {
        $schemaClass = static::getSchemaClass();

        return new $schemaClass();
    }

    /**
     * @param array<string, mixed> $expected
     */
    private static function assertJsonSchemaEquals(array $expected, object $actual): void
    {
        static::assertEquals((object) array_merge(static::getBaseJsonSchema(), $expected), $actual);
    }

    /**
     * @return ObjectProphecy<KeywordInterface>
     */
    protected function mockKeyword(string $key, ?string $value, bool $supportsNullValue = false): ObjectProphecy
    {
        $keyword = $this->prophesize(KeywordInterface::class);
        $keyword->getKey()->willReturn($key);
        $keyword->getValue()->willReturn($value);
        $keyword->supportsNullValue()->willReturn($supportsNullValue);

        return $keyword;
    }

    /**
     * @return ObjectProphecy<SchemaInterface>
     */
    protected function mockSchema(object $jsonSchema): ObjectProphecy
    {
        $schema = $this->prophesize(SchemaInterface::class);
        $schema->toJsonSchema()->willReturn($jsonSchema);

        return $schema;
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::create
     */
    public function testCreate(): void
    {
        $schema = static::getSchemaClass()::create();

        static::assertJsonSchemaEquals([], $schema->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::with
     */
    public function testWith(): void
    {
        $keyword1 = $this->mockKeyword('foo', 'bar');
        $keyword2 = $this->mockKeyword('foo', 'baz');
        $keyword3 = $this->mockKeyword('foo', null, false);
        $keyword4 = $this->mockKeyword('foo', null, true);

        $schema1 = static::createSchema();
        $schema2 = $schema1->with($keyword1->reveal());
        $schema3 = $schema2->with($keyword2->reveal());
        $schema4 = $schema3->with($keyword3->reveal());
        $schema5 = $schema3->with($keyword4->reveal());

        static::assertJsonSchemaEquals([], $schema1->toJsonSchema());
        static::assertJsonSchemaEquals(['foo' => 'bar'], $schema2->toJsonSchema());
        static::assertJsonSchemaEquals(['foo' => 'baz'], $schema3->toJsonSchema());
        static::assertJsonSchemaEquals([], $schema4->toJsonSchema());
        static::assertJsonSchemaEquals(['foo' => null], $schema5->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::comment
     */
    public function testComment(): void
    {
        $schema1 = static::createSchema();
        $schema2 = $schema1->comment('foo');
        $schema3 = $schema2->comment(null);

        static::assertJsonSchemaEquals([], $schema1->toJsonSchema());
        static::assertJsonSchemaEquals(['$comment' => 'foo'], $schema2->toJsonSchema());
        static::assertJsonSchemaEquals([], $schema3->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::title
     */
    public function testTitle(): void
    {
        $schema1 = static::createSchema();
        $schema2 = $schema1->title('foo');
        $schema3 = $schema2->title(null);

        static::assertJsonSchemaEquals([], $schema1->toJsonSchema());
        static::assertJsonSchemaEquals(['title' => 'foo'], $schema2->toJsonSchema());
        static::assertJsonSchemaEquals([], $schema3->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::description
     */
    public function testDescription(): void
    {
        $schema1 = static::createSchema();
        $schema2 = $schema1->description('foo');
        $schema3 = $schema2->description(null);

        static::assertJsonSchemaEquals([], $schema1->toJsonSchema());
        static::assertJsonSchemaEquals(['description' => 'foo'], $schema2->toJsonSchema());
        static::assertJsonSchemaEquals([], $schema3->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::deprecated
     */
    public function testDeprecated(): void
    {
        $schema1 = static::createSchema();
        $schema2 = $schema1->deprecated(false);
        $schema3 = $schema2->deprecated(true);
        $schema4 = $schema3->deprecated(null);

        static::assertJsonSchemaEquals([], $schema1->toJsonSchema());
        static::assertJsonSchemaEquals(['deprecated' => false], $schema2->toJsonSchema());
        static::assertJsonSchemaEquals(['deprecated' => true], $schema3->toJsonSchema());
        static::assertJsonSchemaEquals([], $schema4->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::readOnly
     */
    public function testReadOnly(): void
    {
        $schema1 = static::createSchema();
        $schema2 = $schema1->readOnly(false);
        $schema3 = $schema2->readOnly(true);
        $schema4 = $schema3->readOnly(null);

        static::assertJsonSchemaEquals([], $schema1->toJsonSchema());
        static::assertJsonSchemaEquals(['readOnly' => false], $schema2->toJsonSchema());
        static::assertJsonSchemaEquals(['readOnly' => true], $schema3->toJsonSchema());
        static::assertJsonSchemaEquals([], $schema4->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::writeOnly
     */
    public function testWriteOnly(): void
    {
        $schema1 = static::createSchema();
        $schema2 = $schema1->writeOnly(false);
        $schema3 = $schema2->writeOnly(true);
        $schema4 = $schema3->writeOnly(null);

        static::assertJsonSchemaEquals([], $schema1->toJsonSchema());
        static::assertJsonSchemaEquals(['writeOnly' => false], $schema2->toJsonSchema());
        static::assertJsonSchemaEquals(['writeOnly' => true], $schema3->toJsonSchema());
        static::assertJsonSchemaEquals([], $schema4->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::default
     */
    public function testDefault(): void
    {
        $schema1 = static::createSchema();
        $schema2 = $schema1->default('foo');
        $schema3 = $schema2->default(1);
        $schema4 = $schema3->default(0.5);
        $schema5 = $schema4->default(['foo' => 'bar']);
        $schema6 = $schema5->default((object) ['foo' => 'bar']);
        $schema7 = $schema6->default(false);
        $schema8 = $schema7->default(true);
        $schema9 = $schema8->default(null);

        static::assertJsonSchemaEquals([], $schema1->toJsonSchema());
        static::assertJsonSchemaEquals(['default' => 'foo'], $schema2->toJsonSchema());
        static::assertJsonSchemaEquals(['default' => 1], $schema3->toJsonSchema());
        static::assertJsonSchemaEquals(['default' => 0.5], $schema4->toJsonSchema());
        static::assertJsonSchemaEquals(['default' => ['foo' => 'bar']], $schema5->toJsonSchema());
        static::assertJsonSchemaEquals(['default' => (object) ['foo' => 'bar']], $schema6->toJsonSchema());
        static::assertJsonSchemaEquals(['default' => false], $schema7->toJsonSchema());
        static::assertJsonSchemaEquals(['default' => true], $schema8->toJsonSchema());
        static::assertJsonSchemaEquals(['default' => null], $schema9->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::examples
     */
    public function testExamples(): void
    {
        $schema1 = static::createSchema();
        $schema2 = $schema1->examples([
            'foo',
            1,
            0.5,
            ['foo' => 'bar'],
            (object) ['foo' => 'bar'],
            false,
            true,
            null,
        ]);
        $schema3 = $schema2->examples(null);

        static::assertJsonSchemaEquals([], $schema1->toJsonSchema());
        static::assertJsonSchemaEquals(['examples' => [
            'foo',
            1,
            0.5,
            ['foo' => 'bar'],
            (object) ['foo' => 'bar'],
            false,
            true,
            null,
        ]], $schema2->toJsonSchema());
        static::assertJsonSchemaEquals([], $schema3->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::anyOf
     */
    public function testAnyOf(): void
    {
        $anyOf1 = $this->mockSchema((object) ['foo' => 'bar']);
        $anyOf2 = $this->mockSchema((object) ['bar' => 'baz']);

        $schema1 = static::createSchema();
        $schema2 = $schema1->anyOf([$anyOf1->reveal()]);
        $schema3 = $schema2->anyOf([$anyOf1->reveal(), $anyOf2->reveal()]);
        $schema4 = $schema3->anyOf(null);

        static::assertJsonSchemaEquals([], $schema1->toJsonSchema());
        static::assertJsonSchemaEquals(['anyOf' => [
            (object) ['foo' => 'bar'],
        ]], $schema2->toJsonSchema());
        static::assertJsonSchemaEquals(['anyOf' => [
            (object) ['foo' => 'bar'],
            (object) ['bar' => 'baz'],
        ]], $schema3->toJsonSchema());
        static::assertJsonSchemaEquals([], $schema4->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::allOf
     */
    public function testAllOf(): void
    {
        $allOf1 = $this->mockSchema((object) ['foo' => 'bar']);
        $allOf2 = $this->mockSchema((object) ['bar' => 'baz']);

        $schema1 = static::createSchema();
        $schema2 = $schema1->allOf([$allOf1->reveal()]);
        $schema3 = $schema2->allOf([$allOf1->reveal(), $allOf2->reveal()]);
        $schema4 = $schema3->allOf(null);

        static::assertJsonSchemaEquals([], $schema1->toJsonSchema());
        static::assertJsonSchemaEquals(['allOf' => [
            (object) ['foo' => 'bar'],
        ]], $schema2->toJsonSchema());
        static::assertJsonSchemaEquals(['allOf' => [
            (object) ['foo' => 'bar'],
            (object) ['bar' => 'baz'],
        ]], $schema3->toJsonSchema());
        static::assertJsonSchemaEquals([], $schema4->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::oneOf
     */
    public function testOneOf(): void
    {
        $oneOf1 = $this->mockSchema((object) ['foo' => 'bar']);
        $oneOf2 = $this->mockSchema((object) ['bar' => 'baz']);

        $schema1 = static::createSchema();
        $schema2 = $schema1->oneOf([$oneOf1->reveal()]);
        $schema3 = $schema2->oneOf([$oneOf1->reveal(), $oneOf2->reveal()]);
        $schema4 = $schema3->oneOf(null);

        static::assertJsonSchemaEquals([], $schema1->toJsonSchema());
        static::assertJsonSchemaEquals(['oneOf' => [
            (object) ['foo' => 'bar'],
        ]], $schema2->toJsonSchema());
        static::assertJsonSchemaEquals(['oneOf' => [
            (object) ['foo' => 'bar'],
            (object) ['bar' => 'baz'],
        ]], $schema3->toJsonSchema());
        static::assertJsonSchemaEquals([], $schema4->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::not
     */
    public function testNot(): void
    {
        $not = $this->mockSchema((object) ['foo' => 'bar']);

        $schema1 = static::createSchema();
        $schema2 = $schema1->not($not->reveal());
        $schema3 = $schema2->not(null);

        static::assertJsonSchemaEquals([], $schema1->toJsonSchema());
        static::assertJsonSchemaEquals(['not' => (object) ['foo' => 'bar']], $schema2->toJsonSchema());
        static::assertJsonSchemaEquals([], $schema3->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::if
     */
    public function testIf(): void
    {
        $if = $this->mockSchema((object) ['foo' => 'bar']);

        $schema1 = static::createSchema();
        $schema2 = $schema1->if($if->reveal());
        $schema3 = $schema2->if(null);

        static::assertJsonSchemaEquals([], $schema1->toJsonSchema());
        static::assertJsonSchemaEquals(['if' => (object) ['foo' => 'bar']], $schema2->toJsonSchema());
        static::assertJsonSchemaEquals([], $schema3->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::then
     */
    public function testThen(): void
    {
        $then = $this->mockSchema((object) ['foo' => 'bar']);

        $schema1 = static::createSchema();
        $schema2 = $schema1->then($then->reveal());
        $schema3 = $schema2->then(null);

        static::assertJsonSchemaEquals([], $schema1->toJsonSchema());
        static::assertJsonSchemaEquals(['then' => (object) ['foo' => 'bar']], $schema2->toJsonSchema());
        static::assertJsonSchemaEquals([], $schema3->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::else
     */
    public function testElse(): void
    {
        $else = $this->mockSchema((object) ['foo' => 'bar']);

        $schema1 = static::createSchema();
        $schema2 = $schema1->else($else->reveal());
        $schema3 = $schema2->else(null);

        static::assertJsonSchemaEquals([], $schema1->toJsonSchema());
        static::assertJsonSchemaEquals(['else' => (object) ['foo' => 'bar']], $schema2->toJsonSchema());
        static::assertJsonSchemaEquals([], $schema3->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::const
     */
    public function testConst(): void
    {
        $schema1 = static::createSchema();
        $schema2 = $schema1->const('foo');
        $schema3 = $schema2->const(1);
        $schema4 = $schema3->const(0.5);
        $schema5 = $schema4->const(['foo' => 'bar']);
        $schema6 = $schema5->const((object) ['foo' => 'bar']);
        $schema7 = $schema6->const(false);
        $schema8 = $schema7->const(true);
        $schema9 = $schema8->const(null);

        static::assertJsonSchemaEquals([], $schema1->toJsonSchema());
        static::assertJsonSchemaEquals(['const' => 'foo'], $schema2->toJsonSchema());
        static::assertJsonSchemaEquals(['const' => 1], $schema3->toJsonSchema());
        static::assertJsonSchemaEquals(['const' => 0.5], $schema4->toJsonSchema());
        static::assertJsonSchemaEquals(['const' => ['foo' => 'bar']], $schema5->toJsonSchema());
        static::assertJsonSchemaEquals(['const' => (object) ['foo' => 'bar']], $schema6->toJsonSchema());
        static::assertJsonSchemaEquals(['const' => false], $schema7->toJsonSchema());
        static::assertJsonSchemaEquals(['const' => true], $schema8->toJsonSchema());
        static::assertJsonSchemaEquals(['const' => null], $schema9->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::enum
     */
    public function testEnum(): void
    {
        $schema1 = static::createSchema();
        $schema2 = $schema1->enum([
            'foo',
            1,
            0.5,
            ['foo' => 'bar'],
            (object) ['foo' => 'bar'],
            false,
            true,
            null,
        ]);
        $schema3 = $schema2->enum(null);

        static::assertJsonSchemaEquals([], $schema1->toJsonSchema());
        static::assertJsonSchemaEquals(['enum' => [
            'foo',
            1,
            0.5,
            ['foo' => 'bar'],
            (object) ['foo' => 'bar'],
            false,
            true,
            null,
        ]], $schema2->toJsonSchema());
        static::assertJsonSchemaEquals([], $schema3->toJsonSchema());
    }

    /**
     * @covers \JsonSchema\Schema\AbstractSchema::toJsonSchema
     */
    public function testToJsonSchema(): void
    {
        $keyword1 = $this->mockKeyword('foo', 'bar');
        $keyword2 = $this->mockKeyword('bar', 'baz');
        $keyword3 = $this->mockKeyword('baz', null, true);
        $keyword4 = $this->mockKeyword('other', null, false);

        $schema = static::createSchema()
            ->with($keyword1->reveal())
            ->with($keyword2->reveal())
            ->with($keyword3->reveal())
            ->with($keyword4->reveal());

        static::assertJsonSchemaEquals([
            'foo' => 'bar',
            'bar' => 'baz',
            'baz' => null,
        ], $schema->toJsonSchema());
    }
}
