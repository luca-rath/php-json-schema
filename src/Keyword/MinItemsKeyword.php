<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use Webmozart\Assert\Assert;

class MinItemsKeyword extends AbstractKeyword
{
    const NAME = 'minItems';

    public function __construct(?int $minItems)
    {
        Assert::nullOrNatural($minItems);

        parent::__construct(static::NAME, $minItems);
    }
}
