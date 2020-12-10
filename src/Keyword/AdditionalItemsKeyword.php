<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use JsonSchema\Schema\SchemaInterface;
use Webmozart\Assert\Assert;

class AdditionalItemsKeyword extends AbstractKeyword
{
    const NAME = 'additionalItems';

    /**
     * @param bool|SchemaInterface|null $additionalItems
     */
    public function __construct($additionalItems)
    {
        if (null === $additionalItems || \is_bool($additionalItems)) {
            parent::__construct(static::NAME, $additionalItems);

            return;
        }

        Assert::isInstanceOf($additionalItems, SchemaInterface::class);

        parent::__construct(static::NAME, $additionalItems->toJsonSchema());
    }
}
