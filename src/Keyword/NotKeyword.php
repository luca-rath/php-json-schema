<?php

namespace JsonSchema\Keyword;

use JsonSchema\Schema\SchemaInterface;

class NotKeyword extends AbstractKeyword
{
    const NAME = 'not';

    public function __construct(?SchemaInterface $not)
    {
        if (null === $not) {
            parent::__construct(static::NAME, null);

            return;
        }

        parent::__construct(static::NAME, $not->toJsonSchema());
    }
}
