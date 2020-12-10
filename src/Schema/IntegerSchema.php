<?php

namespace JsonSchema\Schema;

use JsonSchema\Keyword\ExclusiveMaximumKeyword;
use JsonSchema\Keyword\ExclusiveMinimumKeyword;
use JsonSchema\Keyword\MaximumKeyword;
use JsonSchema\Keyword\MinimumKeyword;
use JsonSchema\Keyword\MultipleOfKeyword;
use JsonSchema\Keyword\TypeKeyword;

class IntegerSchema extends AbstractSchema
{
    public function __construct()
    {
        parent::__construct(
            new TypeKeyword('integer')
        );
    }

    /**
     * @return static
     */
    public function nullable(bool $nullable = true): self
    {
        if (!$nullable) {
            return $this->with(
                new TypeKeyword('integer')
            );
        }

        return $this->with(
            new TypeKeyword(['integer', 'null'])
        );
    }

    /**
     * @return static
     */
    public function minimum(?int $minimum): self
    {
        return $this->with(
            new MinimumKeyword($minimum)
        );
    }

    /**
     * @return static
     */
    public function maximum(?int $maximum): self
    {
        return $this->with(
            new MaximumKeyword($maximum)
        );
    }

    /**
     * @return static
     */
    public function exclusiveMinimum(?int $exclusiveMinimum): self
    {
        return $this->with(
            new ExclusiveMinimumKeyword($exclusiveMinimum)
        );
    }

    /**
     * @return static
     */
    public function exclusiveMaximum(?int $exclusiveMaximum): self
    {
        return $this->with(
            new ExclusiveMaximumKeyword($exclusiveMaximum)
        );
    }

    /**
     * @return static
     */
    public function multipleOf(?int $multipleOf): self
    {
        return $this->with(
            new MultipleOfKeyword($multipleOf)
        );
    }
}
