<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

class ConstKeyword extends AbstractKeyword
{
    const NAME = 'const';

    /**
     * @param mixed[]|bool|float|int|object|string|null $const
     */
    public function __construct($const)
    {
        parent::__construct(static::NAME, $const, true);
    }
}
