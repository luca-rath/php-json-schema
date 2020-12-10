<?php

namespace JsonSchema\Schema;

use JsonSchema\Keyword\ExclusiveMaximumKeyword;
use JsonSchema\Keyword\ExclusiveMinimumKeyword;
use JsonSchema\Keyword\MaximumKeyword;
use JsonSchema\Keyword\MinimumKeyword;
use JsonSchema\Keyword\MultipleOfKeyword;
use JsonSchema\Keyword\TypeKeyword;

class NumberSchema extends AbstractSchema
{
    public function __construct()
    {
        parent::__construct(
            new TypeKeyword('number')
        );
    }

    /**
     * @return static
     */
    public function nullable(bool $nullable = true): self
    {
        if (!$nullable) {
            return $this->with(
                new TypeKeyword('number')
            );
        }

        return $this->with(
            new TypeKeyword(['number', 'null'])
        );
    }

    /**
     * @return static
     */
    public function minimum(?float $minimum): self
    {
        return $this->with(
            new MinimumKeyword($minimum)
        );
    }

    /**
     * @return static
     */
    public function maximum(?float $maximum): self
    {
        return $this->with(
            new MaximumKeyword($maximum)
        );
    }

    /**
     * @return static
     */
    public function exclusiveMinimum(?float $exclusiveMinimum): self
    {
        return $this->with(
            new ExclusiveMinimumKeyword($exclusiveMinimum)
        );
    }

    /**
     * @return static
     */
    public function exclusiveMaximum(?float $exclusiveMaximum): self
    {
        return $this->with(
            new ExclusiveMaximumKeyword($exclusiveMaximum)
        );
    }

    /**
     * @return static
     */
    public function multipleOf(?float $multipleOf): self
    {
        return $this->with(
            new MultipleOfKeyword($multipleOf)
        );
    }
}
