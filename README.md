[![Latest Stable Version](https://poser.pugx.org/bentools/violin/v/stable)](https://packagist.org/packages/bentools/violin)
[![License](https://poser.pugx.org/bentools/violin/license)](https://packagist.org/packages/bentools/violin)
[![Build Status](https://img.shields.io/travis/bpolaszek/violin/master.svg?style=flat-square)](https://travis-ci.org/bpolaszek/violin)
[![Coverage Status](https://coveralls.io/repos/github/bpolaszek/violin/badge.svg?branch=master)](https://coveralls.io/github/bpolaszek/violin?branch=master)
[![Quality Score](https://img.shields.io/scrutinizer/g/bpolaszek/violin.svg?style=flat-square)](https://scrutinizer-ci.com/g/bpolaszek/violin)
[![Total Downloads](https://poser.pugx.org/bentools/violin/downloads)](https://packagist.org/packages/bentools/violin)

# Violin 🎻

Violin is a multibyte-compliant, OOP string manipulation library.
 
It is heavily inspired by [Stringy](https://github.com/danielstjules/Stringy), with a main focus on performance: when dealing with thousands of strings, it is sometimes counter-productive to rely on `mb_*` functions, which perform up to 4 times slower than normal `str_*` functions, when you manipulate ASCII strings.

Violin will detect the string's encoding, then decide wether or not to use the mbstring extension (or the Symfony polyfill if the extension is not loaded).

## Installation

PHP 7.1+ is required.

```bash
composer require bentools/violin 1.0.x-dev
```

## Tests

```bash
./vendor/bin/phpunit
```

## Usage

```php
use BenTools\Violin\Violin;

$str = 'fòöbàř     🤗';
print Violin::tune($str)
        ->toUpperCase()
        ->ensureLeft('Welcome ')
        ->collapseWhitespace(); // Welcome FÒÖBÀŘ 🤗
```

## License
MIT