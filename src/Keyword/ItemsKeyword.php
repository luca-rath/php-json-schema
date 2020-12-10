<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use JsonSchema\Schema\SchemaInterface;
use Webmozart\Assert\Assert;

class ItemsKeyword extends AbstractKeyword
{
    const NAME = 'items';

    /**
     * @param SchemaInterface|SchemaInterface[]|null $items
     */
    public function __construct($items)
    {
        if (null === $items) {
            parent::__construct(static::NAME, null);

            return;
        }

        if (\is_array($items)) {
            Assert::isList($items);
            Assert::allIsInstanceOf($items, SchemaInterface::class);

            parent::__construct(static::NAME, array_map(
                function (SchemaInterface $schemaMetadata) {
                    return $schemaMetadata->toJsonSchema();
                },
                $items
            ));

            return;
        }

        Assert::isInstanceOf($items, SchemaInterface::class);

        parent::__construct(static::NAME, $items->toJsonSchema());
    }
}
