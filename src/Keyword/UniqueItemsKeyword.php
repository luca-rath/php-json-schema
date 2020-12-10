<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

class UniqueItemsKeyword extends AbstractKeyword
{
    const NAME = 'uniqueItems';

    public function __construct(?bool $uniqueItems)
    {
        parent::__construct(static::NAME, $uniqueItems);
    }
}
