<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use JsonSchema\Schema\SchemaInterface;
use Webmozart\Assert\Assert;

class UnevaluatedItemsKeyword extends AbstractKeyword
{
    const NAME = 'unevaluatedItems';

    /**
     * @param bool|SchemaInterface|null $unevaluatedItems
     */
    public function __construct($unevaluatedItems)
    {
        if (null === $unevaluatedItems || \is_bool($unevaluatedItems)) {
            parent::__construct(static::NAME, $unevaluatedItems);

            return;
        }

        Assert::isInstanceOf($unevaluatedItems, SchemaInterface::class);

        parent::__construct(static::NAME, $unevaluatedItems->toJsonSchema());
    }
}
