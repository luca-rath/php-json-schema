<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

class MinimumKeyword extends AbstractKeyword
{
    const NAME = 'minimum';

    public function __construct(?float $minimum)
    {
        parent::__construct(static::NAME, $minimum);
    }
}
