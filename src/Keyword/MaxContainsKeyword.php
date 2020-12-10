<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use Webmozart\Assert\Assert;

class MaxContainsKeyword extends AbstractKeyword
{
    const NAME = 'maxContains';

    public function __construct(?int $maxContains)
    {
        Assert::nullOrNatural($maxContains);

        parent::__construct(static::NAME, $maxContains);
    }
}
