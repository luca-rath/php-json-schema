<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

class MaximumKeyword extends AbstractKeyword
{
    const NAME = 'maximum';

    public function __construct(?float $maximum)
    {
        parent::__construct(static::NAME, $maximum);
    }
}
