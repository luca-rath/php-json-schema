<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use JsonSchema\Schema\SchemaInterface;

class ContainsKeyword extends AbstractKeyword
{
    const NAME = 'contains';

    public function __construct(?SchemaInterface $contains)
    {
        if (null === $contains) {
            parent::__construct(static::NAME, null);

            return;
        }

        parent::__construct(static::NAME, $contains->toJsonSchema());
    }
}
