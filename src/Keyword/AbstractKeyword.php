<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use Webmozart\Assert\Assert;

abstract class AbstractKeyword implements KeywordInterface
{
    private string $key;

    /**
     * @var mixed[]|bool|float|int|object|string|null
     */
    private $value;

    private bool $supportsNullValue;

    /**
     * @param mixed[]|bool|float|int|object|string|null $value
     */
    public function __construct(string $key, $value, bool $supportsNullValue = false)
    {
        Assert::stringNotEmpty($key);
        Assert::nullOrOneOf(\gettype($value), [
            'array',
            'boolean',
            'float',
            'double',
            'real',
            'integer',
            'object',
            'string',
            'NULL',
        ]);

        $this->key = $key;
        $this->value = $value;
        $this->supportsNullValue = $supportsNullValue;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function supportsNullValue(): bool
    {
        return $this->supportsNullValue;
    }
}
