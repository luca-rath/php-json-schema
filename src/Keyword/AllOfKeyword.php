<?php

namespace JsonSchema\Keyword;

use JsonSchema\Schema\SchemaInterface;
use Webmozart\Assert\Assert;

class AllOfKeyword extends AbstractKeyword
{
    const NAME = 'allOf';

    /**
     * @param SchemaInterface[]|null $allOfs
     */
    public function __construct(?array $allOfs)
    {
        if (null === $allOfs) {
            parent::__construct(static::NAME, null);

            return;
        }

        Assert::isNonEmptyList($allOfs);
        Assert::allIsInstanceOf($allOfs, SchemaInterface::class);

        parent::__construct(static::NAME, array_map(
            function (SchemaInterface $schemaMetadata) {
                return $schemaMetadata->toJsonSchema();
            },
            $allOfs
        ));
    }
}
