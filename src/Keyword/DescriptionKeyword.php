<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

class DescriptionKeyword extends AbstractKeyword
{
    const NAME = 'description';

    public function __construct(?string $description)
    {
        // TODO uncomment https://github.com/phpstan/phpstan-webmozart-assert/issues/33
        // Assert::nullOrStringNotEmpty($description);

        parent::__construct(static::NAME, $description);
    }
}
