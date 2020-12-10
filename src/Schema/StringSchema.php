<?php

namespace JsonSchema\Schema;

use JsonSchema\Keyword\FormatKeyword;
use JsonSchema\Keyword\MaxLengthKeyword;
use JsonSchema\Keyword\MinLengthKeyword;
use JsonSchema\Keyword\PatternKeyword;
use JsonSchema\Keyword\TypeKeyword;

class StringSchema extends AbstractSchema
{
    public function __construct()
    {
        parent::__construct(
            new TypeKeyword('string')
        );
    }

    /**
     * @return static
     */
    public function nullable(bool $nullable = true): self
    {
        if (!$nullable) {
            return $this->with(
                new TypeKeyword('string')
            );
        }

        return $this->with(
            new TypeKeyword(['string', 'null'])
        );
    }

    /**
     * @return static
     */
    public function minLength(?int $minLength): self
    {
        return $this->with(
            new MinLengthKeyword($minLength)
        );
    }

    /**
     * @return static
     */
    public function maxLength(?int $maxLength): self
    {
        return $this->with(
            new MaxLengthKeyword($maxLength)
        );
    }

    /**
     * @return static
     */
    public function pattern(?string $pattern): self
    {
        return $this->with(
            new PatternKeyword($pattern)
        );
    }

    /**
     * @return static
     */
    public function format(?string $format): self
    {
        return $this->with(
            new FormatKeyword($format)
        );
    }
}
