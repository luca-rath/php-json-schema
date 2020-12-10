<?php

declare(strict_types=1);

namespace JsonSchema\Schema;

interface SchemaInterface
{
    public function __construct();

    public function toJsonSchema(): object;

    /**
     * @return static
     */
    public static function create(): self;
}
