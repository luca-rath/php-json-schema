<?php

namespace JsonSchema\Schema;

use JsonSchema\Keyword\TypeKeyword;

class Schema extends AbstractSchema
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string|string[]|null $type
     *
     * @return static
     */
    public function type($type): self
    {
        return $this->with(
            new TypeKeyword($type)
        );
    }
}
