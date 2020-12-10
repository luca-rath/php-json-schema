<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

class TitleKeyword extends AbstractKeyword
{
    const NAME = 'title';

    public function __construct(?string $title)
    {
        // TODO uncomment https://github.com/phpstan/phpstan-webmozart-assert/issues/33
        // Assert::nullOrStringNotEmpty($title);

        parent::__construct(static::NAME, $title);
    }
}
