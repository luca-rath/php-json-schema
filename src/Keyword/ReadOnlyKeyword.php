<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

class ReadOnlyKeyword extends AbstractKeyword
{
    const NAME = 'readOnly';

    public function __construct(?bool $readOnly)
    {
        parent::__construct(static::NAME, $readOnly);
    }
}
