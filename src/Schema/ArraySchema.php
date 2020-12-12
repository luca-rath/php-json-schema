<?php

namespace JsonSchema\Schema;

use JsonSchema\Keyword\AdditionalItemsKeyword;
use JsonSchema\Keyword\ContainsKeyword;
use JsonSchema\Keyword\ItemsKeyword;
use JsonSchema\Keyword\MaxContainsKeyword;
use JsonSchema\Keyword\MaxItemsKeyword;
use JsonSchema\Keyword\MinContainsKeyword;
use JsonSchema\Keyword\MinItemsKeyword;
use JsonSchema\Keyword\TypeKeyword;
use JsonSchema\Keyword\UnevaluatedItemsKeyword;
use JsonSchema\Keyword\UniqueItemsKeyword;

class ArraySchema extends AbstractSchema
{
    public function __construct()
    {
        parent::__construct(
            new TypeKeyword('array')
        );
    }

    /**
     * @return static
     */
    public function nullable(bool $nullable = true): self
    {
        if (!$nullable) {
            return $this->with(
                new TypeKeyword('array')
            );
        }

        return $this->with(
            new TypeKeyword(['array', 'null'])
        );
    }

    /**
     * @param SchemaInterface|SchemaInterface[]|null $items
     *
     * @return static
     */
    public function items($items): self
    {
        return $this->with(
            new ItemsKeyword($items)
        );
    }

    /**
     * @return static
     */
    public function contains(?SchemaInterface $contains): self
    {
        return $this->with(
            new ContainsKeyword($contains)
        );
    }

    /**
     * @param bool|SchemaInterface|null $additionalItems
     *
     * @return static
     */
    public function additionalItems($additionalItems): self
    {
        return $this->with(
            new AdditionalItemsKeyword($additionalItems)
        );
    }

    /**
     * @param bool|SchemaInterface|null $unevaluatedItems
     *
     * @return static
     */
    public function unevaluatedItems($unevaluatedItems): self
    {
        return $this->with(
            new UnevaluatedItemsKeyword($unevaluatedItems)
        );
    }

    /**
     * @return static
     */
    public function minItems(?int $minItems): self
    {
        return $this->with(
            new MinItemsKeyword($minItems)
        );
    }

    /**
     * @return static
     */
    public function maxItems(?int $maxItems): self
    {
        return $this->with(
            new MaxItemsKeyword($maxItems)
        );
    }

    /**
     * @return static
     */
    public function minContains(?int $minContains): self
    {
        return $this->with(
            new MinContainsKeyword($minContains)
        );
    }

    /**
     * @return static
     */
    public function maxContains(?int $maxContains): self
    {
        return $this->with(
            new MaxContainsKeyword($maxContains)
        );
    }

    /**
     * @return static
     */
    public function uniqueItems(?bool $uniqueItems): self
    {
        return $this->with(
            new UniqueItemsKeyword($uniqueItems)
        );
    }
}
