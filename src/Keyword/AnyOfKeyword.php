<?php

namespace JsonSchema\Keyword;

use JsonSchema\Schema\SchemaInterface;
use Webmozart\Assert\Assert;

class AnyOfKeyword extends AbstractKeyword
{
    const NAME = 'anyOf';

    /**
     * @param SchemaInterface[]|null $anyOfs
     */
    public function __construct(?array $anyOfs)
    {
        if (null === $anyOfs) {
            parent::__construct(static::NAME, null);

            return;
        }

        Assert::isNonEmptyList($anyOfs);
        Assert::allIsInstanceOf($anyOfs, SchemaInterface::class);

        parent::__construct(static::NAME, array_map(
            function (SchemaInterface $schemaMetadata) {
                return $schemaMetadata->toJsonSchema();
            },
            $anyOfs
        ));
    }
}
