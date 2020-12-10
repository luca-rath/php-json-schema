<?php

namespace JsonSchema\Keyword;

use JsonSchema\Schema\SchemaInterface;

class ElseKeyword extends AbstractKeyword
{
    const NAME = 'else';

    public function __construct(?SchemaInterface $else)
    {
        if (null === $else) {
            parent::__construct(static::NAME, null);

            return;
        }

        parent::__construct(static::NAME, $else->toJsonSchema());
    }
}
