<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use Webmozart\Assert\Assert;

class EnumKeyword extends AbstractKeyword
{
    const NAME = 'enum';

    /**
     * @param array<mixed[]|bool|float|int|object|string|null>|null $enum
     */
    public function __construct(?array $enum)
    {
        if (null === $enum) {
            parent::__construct(static::NAME, null);

            return;
        }

        Assert::isNonEmptyList($enum);

        parent::__construct(static::NAME, $enum);
    }
}
