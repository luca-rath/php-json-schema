<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

class ExclusiveMaximumKeyword extends AbstractKeyword
{
    const NAME = 'exclusiveMaximum';

    public function __construct(?float $exclusiveMaximum)
    {
        parent::__construct(static::NAME, $exclusiveMaximum);
    }
}
