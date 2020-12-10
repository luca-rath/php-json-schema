<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use Webmozart\Assert\Assert;

class PatternKeyword extends AbstractKeyword
{
    const NAME = 'pattern';

    public function __construct(?string $pattern)
    {
        // TODO uncomment https://github.com/phpstan/phpstan-webmozart-assert/issues/33
        // Assert::nullOrStringNotEmpty($pattern);

        parent::__construct(static::NAME, $pattern);
    }
}
