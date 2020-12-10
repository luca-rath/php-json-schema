<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

use JsonSchema\Schema\SchemaInterface;
use Webmozart\Assert\Assert;

class AdditionalPropertiesKeyword extends AbstractKeyword
{
    const NAME = 'additionalProperties';

    /**
     * @param bool|SchemaInterface|null $additionalProperties
     */
    public function __construct($additionalProperties)
    {
        if (null === $additionalProperties || \is_bool($additionalProperties)) {
            parent::__construct(static::NAME, $additionalProperties);

            return;
        }

        Assert::isInstanceOf($additionalProperties, SchemaInterface::class);

        parent::__construct(static::NAME, $additionalProperties->toJsonSchema());
    }
}
