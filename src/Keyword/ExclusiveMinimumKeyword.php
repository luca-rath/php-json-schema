<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

class ExclusiveMinimumKeyword extends AbstractKeyword
{
    const NAME = 'exclusiveMinimum';

    public function __construct(?float $exclusiveMinimum)
    {
        parent::__construct(static::NAME, $exclusiveMinimum);
    }
}
