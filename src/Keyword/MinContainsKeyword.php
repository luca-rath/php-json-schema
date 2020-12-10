<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use Webmozart\Assert\Assert;

class MinContainsKeyword extends AbstractKeyword
{
    const NAME = 'minContains';

    public function __construct(?int $minContains)
    {
        Assert::nullOrNatural($minContains);

        parent::__construct(static::NAME, $minContains);
    }
}
