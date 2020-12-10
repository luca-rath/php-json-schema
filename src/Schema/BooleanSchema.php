<?php

namespace JsonSchema\Schema;

use JsonSchema\Keyword\TypeKeyword;

class BooleanSchema extends AbstractSchema
{
    public function __construct()
    {
        parent::__construct(
            new TypeKeyword('boolean')
        );
    }

    /**
     * @return static
     */
    public function nullable(bool $nullable = true): self
    {
        if (!$nullable) {
            return $this->with(
                new TypeKeyword('boolean')
            );
        }

        return $this->with(
            new TypeKeyword(['boolean', 'null'])
        );
    }
}
