<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use Webmozart\Assert\Assert;

class MultipleOfKeyword extends AbstractKeyword
{
    const NAME = 'multipleOf';

    public function __construct(?float $multipleOf)
    {
        Assert::nullOrGreaterThan($multipleOf, 0);

        parent::__construct(static::NAME, $multipleOf);
    }
}
