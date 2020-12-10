<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

class WriteOnlyKeyword extends AbstractKeyword
{
    const NAME = 'writeOnly';

    public function __construct(?bool $writeOnly)
    {
        parent::__construct(static::NAME, $writeOnly);
    }
}
