<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

class DeprecatedKeyword extends AbstractKeyword
{
    const NAME = 'deprecated';

    public function __construct(?bool $deprecated)
    {
        parent::__construct(static::NAME, $deprecated);
    }
}
