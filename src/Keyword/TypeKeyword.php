<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use Webmozart\Assert\Assert;

class TypeKeyword extends AbstractKeyword
{
    const NAME = 'type';

    /**
     * @param string|string[]|null $type
     */
    public function __construct($type)
    {
        if (\is_array($type)) {
            Assert::isNonEmptyList($type);
            Assert::allStringNotEmpty($type);
            Assert::uniqueValues($type);
        } else {
            Assert::nullOrStringNotEmpty($type);
        }

        parent::__construct(static::NAME, $type);
    }
}
