<?php

declare(strict_types=1);

namespace JsonSchema\Keyword;

class FormatKeyword extends AbstractKeyword
{
    const NAME = 'format';

    // Dates and times
    const FORMAT_DATE_TIME = 'date-time';
    const FORMAT_DATE = 'date';
    const FORMAT_TIME = 'time';
    const FORMAT_DURATION = 'duration';

    // Email addresses
    const FORMAT_EMAIL = 'email';
    const FORMAT_IDN_EMAIL = 'idn-email';

    // Hostnames
    const FORMAT_HOSTNAME = 'hostname';
    const FORMAT_IDN_HOSTNAME = 'idn-hostname';

    // IP Addresses
    const FORMAT_IPV4 = 'ipv4';
    const FORMAT_IPV6 = 'ipv6';

    // Resource identifiers
    const FORMAT_URI = 'uri';
    const FORMAT_URI_REFERENCE = 'uri-reference';
    const FORMAT_IRI = 'iri';
    const FORMAT_IRI_REFERENCE = 'iri-reference';
    const FORMAT_UUID = 'uuid';

    // URI template
    const FORMAT_URI_TEMPLATE = 'uri-template';

    // JSON Pointer
    const FORMAT_JSON_POINTER = 'json-pointer';
    const FORMAT_RELATIVE_JSON_POINTER = 'relative-json-pointer';

    // Regular Expressions
    const FORMAT_REGEX = 'regex';

    public function __construct(?string $format)
    {
        // TODO uncomment https://github.com/phpstan/phpstan-webmozart-assert/issues/33
        // Assert::nullOrStringNotEmpty($format);

        parent::__construct(static::NAME, $format);
    }
}
