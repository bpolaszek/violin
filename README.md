# Violin

Violin is a multibyte-compliant, OOP string manipulation library.
 
It is heavily inspired by [Stringy](https://github.com/danielstjules/Stringy) (and sometimes, copied/pasted), with a main focus on performance. 

When dealing with thousands of strings, it is sometimes counter-productive to rely on `mb_*` functions, which perform up to 4 times slower than normal `str_*` functions, when you manipulate ASCII strings.

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