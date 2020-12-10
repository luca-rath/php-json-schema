<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use Webmozart\Assert\Assert;

class MaxLengthKeyword extends AbstractKeyword
{
    const NAME = 'maxLength';

    public function __construct(?int $maxLength)
    {
        Assert::nullOrNatural($maxLength);

        parent::__construct(static::NAME, $maxLength);
    }
}
