<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

class DefaultKeyword extends AbstractKeyword
{
    const NAME = 'default';

    /**
     * @param mixed[]|bool|float|int|object|string|null $default
     */
    public function __construct($default)
    {
        parent::__construct(static::NAME, $default, true);
    }
}
