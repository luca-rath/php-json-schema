<?php

namespace JsonSchema\Schema;

use JsonSchema\Keyword\AllOfKeyword;
use JsonSchema\Keyword\AnyOfKeyword;
use JsonSchema\Keyword\CommentKeyword;
use JsonSchema\Keyword\ConstKeyword;
use JsonSchema\Keyword\DefaultKeyword;
use JsonSchema\Keyword\DeprecatedKeyword;
use JsonSchema\Keyword\DescriptionKeyword;
use JsonSchema\Keyword\ElseKeyword;
use JsonSchema\Keyword\EnumKeyword;
use JsonSchema\Keyword\ExamplesKeyword;
use JsonSchema\Keyword\IfKeyword;
use JsonSchema\Keyword\KeywordInterface;
use JsonSchema\Keyword\NotKeyword;
use JsonSchema\Keyword\OneOfKeyword;
use JsonSchema\Keyword\ReadOnlyKeyword;
use JsonSchema\Keyword\ThenKeyword;
use JsonSchema\Keyword\TitleKeyword;
use JsonSchema\Keyword\WriteOnlyKeyword;

class AbstractSchema implements SchemaInterface
{
    /**
     * @var array<string, string|bool|int|float|array|object|null>
     */
    private array $jsonSchema = [];

    public function __construct(KeywordInterface $keyword = null)
    {
        if (null !== $keyword) {
            $this->addKeyword($keyword);
        }
    }

    /**
     * @return static
     */
    public function comment(?string $comment): self
    {
        return $this->with(
            new CommentKeyword($comment)
        );
    }

    /**
     * @return static
     */
    public function title(?string $title): self
    {
        return $this->with(
            new TitleKeyword($title)
        );
    }

    /**
     * @return static
     */
    public function description(?string $description): self
    {
        return $this->with(
            new DescriptionKeyword($description)
        );
    }

    /**
     * @return static
     */
    public function deprecated(?bool $deprecated): self
    {
        return $this->with(
            new DeprecatedKeyword($deprecated)
        );
    }

    /**
     * @return static
     */
    public function readOnly(?bool $readOnly): self
    {
        return $this->with(
            new ReadOnlyKeyword($readOnly)
        );
    }

    /**
     * @return static
     */
    public function writeOnly(?bool $writeOnly): self
    {
        return $this->with(
            new WriteOnlyKeyword($writeOnly)
        );
    }

    /**
     * @param mixed[]|bool|float|int|object|string|null $default
     *
     * @return static
     */
    public function default($default): self
    {
        return $this->with(
            new DefaultKeyword($default)
        );
    }

    /**
     * @param array<mixed[]|bool|float|int|object|string|null>|null $examples
     *
     * @return static
     */
    public function examples(?array $examples): self
    {
        return $this->with(
            new ExamplesKeyword($examples)
        );
    }

    /**
     * @param SchemaInterface[]|null $anyOfs
     *
     * @return static
     */
    public function anyOf(?array $anyOfs): self
    {
        return $this->with(
            new AnyOfKeyword($anyOfs)
        );
    }

    /**
     * @param SchemaInterface[]|null $allOfs
     *
     * @return static
     */
    public function allOf(?array $allOfs): self
    {
        return $this->with(
            new AllOfKeyword($allOfs)
        );
    }

    /**
     * @param SchemaInterface[]|null $oneOfs
     *
     * @return static
     */
    public function oneOf(?array $oneOfs): self
    {
        return $this->with(
            new OneOfKeyword($oneOfs)
        );
    }

    /**
     * @return static
     */
    public function not(?SchemaInterface $not): self
    {
        return $this->with(
            new NotKeyword($not)
        );
    }

    /**
     * @return static
     */
    public function if(?SchemaInterface $if): self
    {
        return $this->with(
            new IfKeyword($if)
        );
    }

    /**
     * @return static
     */
    public function then(?SchemaInterface $then): self
    {
        return $this->with(
            new ThenKeyword($then)
        );
    }

    /**
     * @return static
     */
    public function else(?SchemaInterface $else): self
    {
        return $this->with(
            new ElseKeyword($else)
        );
    }

    /**
     * @param mixed[]|bool|float|int|object|string|null $const
     *
     * @return static
     */
    public function const($const): self
    {
        return $this->with(
            new ConstKeyword($const)
        );
    }

    /**
     * @param array<mixed[]|bool|float|int|object|string|null>|null $enum
     *
     * @return static
     */
    public function enum(?array $enum): self
    {
        return $this->with(
            new EnumKeyword($enum)
        );
    }

    /**
     * @return static
     */
    public function with(KeywordInterface $keyword): self
    {
        $instance = clone $this;
        $instance->addKeyword($keyword);

        return $instance;
    }

    private function addKeyword(KeywordInterface $keyword): void
    {
        $key = $keyword->getKey();
        unset($this->jsonSchema[$key]);

        $value = $keyword->getValue();
        if ($keyword->supportsNullValue() || null !== $value) {
            $this->jsonSchema[$key] = $value;
        }
    }

    public function toJsonSchema(): object
    {
        return (object) $this->jsonSchema;
    }

    /**
     * @return static
     */
    public static function create(): self
    {
        return new static();
    }
}
