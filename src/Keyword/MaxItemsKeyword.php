<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use Webmozart\Assert\Assert;

class MaxItemsKeyword extends AbstractKeyword
{
    const NAME = 'maxItems';

    public function __construct(?int $maxItems)
    {
        Assert::nullOrNatural($maxItems);

        parent::__construct(static::NAME, $maxItems);
    }
}
