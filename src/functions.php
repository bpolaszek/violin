<?php

namespace BenTools\Violin;

/**
 * @param $str
 * @return Violin
 * @throws \InvalidArgumentException
 */
function string($str): Violin
{
    return Violin::tune($str);
}

/**
 * @param $str
 * @return bool
 */
function is_stringable($str): bool
{
    return Violin::isStringable($str);
}

/**
 * @param $str
 * @return bool
 * @throws \InvalidArgumentException
 */
function is_empty($str): bool
{
    return string($str)->isEmpty();
}

/**
 * @param $str
 * @return bool
 * @throws \InvalidArgumentException
 */
function is_blank($str): bool
{
    return string($str)->isBlank();
}

/**
 * @param $str
 * @return string
 * @throws \InvalidArgumentException
 */
function strtoupper($str): string
{
    return (string) string($str)->toUpperCase();
}

/**
 * @param $str
 * @return string
 * @throws \InvalidArgumentException
 */
function strtolower($str): string
{
    return (string) string($str)->toLowerCase();
}

/**
 * @param          $str
 * @param int      $start
 * @param int|null $length
 * @return string
 * @throws \InvalidArgumentException
 */
function substr($str, int $start, int $length = null): string
{
    return (string) string($str)->substr($start, $length);
}

/**
 * @param      $str
 * @param      $separator
 * @param bool $include
 * @return null|string
 * @throws \InvalidArgumentException
 */
function substring_after_first($str, $separator, bool $include = false): ?string
{
    return (string) string($str)->substringAfterFirst($separator, $include);
}

/**
 * @param      $str
 * @param      $separator
 * @param bool $include
 * @return null|string
 * @throws \InvalidArgumentException
 */
function substring_after_last($str, $separator, bool $include = false): ?string
{
    return (string) string($str)->substringAfterLast($separator, $include);
}

/**
 * @param      $str
 * @param      $separator
 * @param bool $include
 * @return null|string
 * @throws \InvalidArgumentException
 */
function substring_before_first($str, $separator, bool $include = false): ?string
{
    return (string) string($str)->substringBeforeFirst($separator, $include);
}

/**
 * @param      $str
 * @param      $separator
 * @param bool $include
 * @return null|string
 * @throws \InvalidArgumentException
 */
function substring_before_last($str, $separator, bool $include = false): ?string
{
    return (string) string($str)->substringBeforeLast($separator, $include);
}

/**
 * @param     $str
 * @param int $numberOfChars
 * @return string
 * @throws \InvalidArgumentException
 */
function first($str, int $numberOfChars = 1): string
{
    return (string) string($str)->first($numberOfChars);
}

/**
 * @param     $str
 * @param int $numberOfChars
 * @return string
 * @throws \InvalidArgumentException
 */
function last($str, int $numberOfChars = 1): string
{
    return (string) string($str)->last($numberOfChars);
}

/**
 * @param $haystack
 * @param $needle
 * @return bool
 * @throws \InvalidArgumentException
 */
function starts_with($haystack, $needle): bool
{
    return string($haystack)->startsWith($needle);
}

/**
 * @param $haystack
 * @param $needle
 * @return bool
 * @throws \InvalidArgumentException
 */
function starts_with_any($haystack, $needle): bool
{
    return string($haystack)->startsWithAny($needle);
}

/**
 * @param $haystack
 * @param $needle
 * @return bool
 * @throws \InvalidArgumentException
 */
function ends_with($haystack, $needle): bool
{
    return string($haystack)->endsWith($needle);
}

/**
 * @param $haystack
 * @param $needle
 * @return bool
 * @throws \InvalidArgumentException
 */
function ends_with_any($haystack, $needle): bool
{
    return string($haystack)->endsWithAny($needle);
}

/**
 * @param $haystack
 * @param $needle
 * @return string
 * @throws \InvalidArgumentException
 */
function ensure_left($haystack, $needle): string
{
    return (string) string($haystack)->ensureLeft($needle);
}

/**
 * @param $haystack
 * @param $needle
 * @return string
 * @throws \InvalidArgumentException
 */
function ensure_right($haystack, $needle): string
{
    return (string) string($haystack)->ensureLeft($needle);
}

/**
 * @param $haystack
 * @param $needle
 * @return string
 * @throws \InvalidArgumentException
 */
function remove_left($haystack, $needle): string
{
    return (string) string($haystack)->removeLeft($needle);
}

/**
 * @param $haystack
 * @param $needle
 * @return string
 * @throws \InvalidArgumentException
 */
function remove_right($haystack, $needle): string
{
    return (string) string($haystack)->removeRight($needle);
}

/**
 * @param        $str
 * @param string $charlist
 * @return string
 * @throws \InvalidArgumentException
 */
function trim($str, string $charlist = " \t\n\r\0\x0B"): string
{
    return (string) string($str)->trim($charlist);
}

/**
 * @param        $str
 * @param string $charlist
 * @return string
 * @throws \InvalidArgumentException
 */
function ltrim($str, string $charlist = " \t\n\r\0\x0B"): string
{
    return (string) string($str)->trimLeft($charlist);
}

/**
 * @param        $str
 * @param string $charlist
 * @return string
 * @throws \InvalidArgumentException
 */
function rtrim($str, string $charlist = " \t\n\r\0\x0B"): string
{
    return (string) string($str)->trimRight($charlist);
}

/**
 * @param $str
 * @return string
 * @throws \InvalidArgumentException
 */
function strrev($str): string
{
    return (string) string($str)->reverse();
}

/**
 * @param        $haystack
 * @param string $needle
 * @param int    $offset
 * @return bool|false|int
 * @throws \InvalidArgumentException
 */
function strpos($haystack, string $needle, int $offset = 0)
{
    return string($haystack)->indexOf($needle, $offset, true);
}

/**
 * @param        $haystack
 * @param string $needle
 * @param int    $offset
 * @return bool|false|int
 * @throws \InvalidArgumentException
 */
function stripos($haystack, string $needle, int $offset = 0)
{
    return string($haystack)->indexOf($needle, $offset, false);
}

/**
 * @param        $haystack
 * @param string $needle
 * @param int    $offset
 * @return bool|false|int
 * @throws \InvalidArgumentException
 */
function strrpos($haystack, string $needle, int $offset = 0)
{
    return string($haystack)->indexOfLast($needle, $offset, true);
}

/**
 * @param        $haystack
 * @param string $needle
 * @param int    $offset
 * @return bool|false|int
 * @throws \InvalidArgumentException
 */
function strripos($haystack, string $needle, int $offset = 0)
{
    return string($haystack)->indexOfLast($needle, $offset, false);
}

/**
 * @param        $haystack
 * @param string $needle
 * @param bool   $caseSensitive
 * @return bool
 * @throws \InvalidArgumentException
 */
function contains($haystack, string $needle, bool $caseSensitive = false): bool
{
    return string($haystack)->contains($needle, $caseSensitive);
}

/**
 * @param          $haystack
 * @param iterable $needles
 * @param bool     $caseSensitive
 * @return bool
 * @throws \InvalidArgumentException
 */
function contains_any($haystack, iterable $needles, bool $caseSensitive = false): bool
{
    return string($haystack)->containsAny($needles, $caseSensitive);
}

/**
 * @param          $haystack
 * @param iterable $needles
 * @param bool     $caseSensitive
 * @return bool
 * @throws \InvalidArgumentException
 */
function contains_all($haystack, iterable $needles, bool $caseSensitive = false): bool
{
    return string($haystack)->containsAll($needles, $caseSensitive);
}
