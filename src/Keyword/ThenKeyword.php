<?php

namespace JsonSchema\Keyword;

use JsonSchema\Schema\SchemaInterface;

class ThenKeyword extends AbstractKeyword
{
    const NAME = 'then';

    public function __construct(?SchemaInterface $then)
    {
        if (null === $then) {
            parent::__construct(static::NAME, null);

            return;
        }

        parent::__construct(static::NAME, $then->toJsonSchema());
    }
}
