<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use Webmozart\Assert\Assert;

class MinPropertiesKeyword extends AbstractKeyword
{
    const NAME = 'minProperties';

    public function __construct(?int $minProperties)
    {
        Assert::nullOrNatural($minProperties);

        parent::__construct(static::NAME, $minProperties);
    }
}
