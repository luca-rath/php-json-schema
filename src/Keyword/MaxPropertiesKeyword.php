<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use Webmozart\Assert\Assert;

class MaxPropertiesKeyword extends AbstractKeyword
{
    const NAME = 'maxProperties';

    public function __construct(?int $maxProperties)
    {
        Assert::nullOrNatural($maxProperties);

        parent::__construct(static::NAME, $maxProperties);
    }
}
