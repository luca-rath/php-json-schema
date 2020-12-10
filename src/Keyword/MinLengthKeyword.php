<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use Webmozart\Assert\Assert;

class MinLengthKeyword extends AbstractKeyword
{
    const NAME = 'minLength';

    public function __construct(?int $minLength)
    {
        Assert::nullOrNatural($minLength);

        parent::__construct(static::NAME, $minLength);
    }
}
