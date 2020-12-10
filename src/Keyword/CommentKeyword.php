<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

class CommentKeyword extends AbstractKeyword
{
    const NAME = '$comment';

    public function __construct(?string $comment)
    {
        // TODO uncomment https://github.com/phpstan/phpstan-webmozart-assert/issues/33
        // Assert::nullOrStringNotEmpty($comment);

        parent::__construct(static::NAME, $comment);
    }
}
