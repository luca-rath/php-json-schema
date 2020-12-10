<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

interface KeywordInterface
{
    public function getKey(): string;

    /**
     * @return mixed[]|bool|float|int|object|string|null
     */
    public function getValue();

    public function supportsNullValue(): bool;
}
