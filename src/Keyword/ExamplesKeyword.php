<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use Webmozart\Assert\Assert;

class ExamplesKeyword extends AbstractKeyword
{
    const NAME = 'examples';

    /**
     * @param array<mixed[]|bool|float|int|object|string|null>|null $examples
     */
    public function __construct(?array $examples)
    {
        if (null === $examples) {
            parent::__construct(static::NAME, null);

            return;
        }

        Assert::isNonEmptyList($examples);

        parent::__construct(static::NAME, $examples);
    }
}
