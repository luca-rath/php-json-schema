<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use JsonSchema\Schema\SchemaInterface;
use Webmozart\Assert\Assert;

class UnevaluatedPropertiesKeyword extends AbstractKeyword
{
    const NAME = 'unevaluatedProperties';

    /**
     * @param bool|SchemaInterface|null $unevaluatedProperties
     */
    public function __construct($unevaluatedProperties)
    {
        if (null === $unevaluatedProperties || \is_bool($unevaluatedProperties)) {
            parent::__construct(static::NAME, $unevaluatedProperties);

            return;
        }

        Assert::isInstanceOf($unevaluatedProperties, SchemaInterface::class);

        parent::__construct(static::NAME, $unevaluatedProperties->toJsonSchema());
    }
}
