<?php

namespace JsonSchema\Schema;

use JsonSchema\Keyword\TypeKeyword;

class NullSchema extends AbstractSchema
{
    public function __construct()
    {
        parent::__construct(
            new TypeKeyword('null')
        );
    }
}
