<?php

namespace JsonSchema\Keyword;

use JsonSchema\Schema\StringSchema;

class PropertyNamesKeyword extends AbstractKeyword
{
    const NAME = 'propertyNames';

    public function __construct(?StringSchema $propertyNames)
    {
        if (null === $propertyNames) {
            parent::__construct(static::NAME, null);

            return;
        }

        parent::__construct(static::NAME, $propertyNames->toJsonSchema());
    }
}
