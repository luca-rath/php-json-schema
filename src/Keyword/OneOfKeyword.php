<?php

namespace JsonSchema\Keyword;

use JsonSchema\Schema\SchemaInterface;
use Webmozart\Assert\Assert;

class OneOfKeyword extends AbstractKeyword
{
    const NAME = 'oneOf';

    /**
     * @param SchemaInterface[]|null $oneOfs
     */
    public function __construct(?array $oneOfs)
    {
        if (null === $oneOfs) {
            parent::__construct(static::NAME, null);

            return;
        }

        Assert::isNonEmptyList($oneOfs);
        Assert::allIsInstanceOf($oneOfs, SchemaInterface::class);

        parent::__construct(static::NAME, array_map(
            function (SchemaInterface $schemaMetadata) {
                return $schemaMetadata->toJsonSchema();
            },
            $oneOfs
        ));
    }
}
