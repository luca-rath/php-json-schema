# PHP JSON Schema

[![GitHub](https://img.shields.io/github/license/luca-rath/php-json-schema)](LICENSE)
[![GitHub tag (latest SemVer)](https://img.shields.io/github/v/tag/luca-rath/php-json-schema?sort=semver)](https://github.com/luca-rath/php-json-schema/releases)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/luca-rath/php-json-schema/Tests?label=github%20actions)](https://github.com/luca-rath/php-json-schema/actions?query=workflow%3Atests)
[![Coveralls github](https://img.shields.io/coveralls/github/luca-rath/php-json-schema?label=coveralls)](https://coveralls.io/github/luca-rath/php-json-schema)
[![Scrutinizer build (GitHub/Bitbucket)](https://img.shields.io/scrutinizer/build/g/luca-rath/php-json-schema/main?label=scrutinizer)](https://scrutinizer-ci.com/g/luca-rath/php-json-schema/build-status/main)
[![Scrutinizer code quality (GitHub/Bitbucket)](https://img.shields.io/scrutinizer/quality/g/luca-rath/php-json-schema/main)](https://scrutinizer-ci.com/g/luca-rath/php-json-schema/?branch=main)

PHP classes to help create json schemas

## Installation

```bash
composer require luca-rath/php-json-schema
```

## Usage

```php
use JsonSchema\Keyword\FormatKeyword;
use JsonSchema\Property\Property;
use JsonSchema\Schema\IntegerSchema;
use JsonSchema\Schema\ObjectSchema;
use JsonSchema\Schema\StringSchema;

ObjectSchema::create()
    ->title('Registration form')
    ->properties([
        Property::create('email', true, StringSchema::create()
            ->format(FormatKeyword::FORMAT_EMAIL)
            ->examples(['admin@example.org'])),
        Property::create('password', true, StringSchema::create()
            ->minLength(8)
            ->description('The password must be at least eight characters long')),
        Property::create('age', false, IntegerSchema::create()
            ->nullable()
            ->minimum(18)),
    ]);
```
