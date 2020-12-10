<?php

namespace JsonSchema\Keyword;

use JsonSchema\Schema\SchemaInterface;

class IfKeyword extends AbstractKeyword
{
    const NAME = 'if';

    public function __construct(?SchemaInterface $if)
    {
        if (null === $if) {
            parent::__construct(static::NAME, null);

            return;
        }

        parent::__construct(static::NAME, $if->toJsonSchema());
    }
}
