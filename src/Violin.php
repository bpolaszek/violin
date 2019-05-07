<?php

namespace BenTools\Violin;

use BenTools\Violin\RegularExpressionHandler as Regex;

final class Violin implements \Countable
{

    const ASCII = 'ASCII';

    /**
     * @var string
     */
    private $str;

    /**
     * @var string
     */
    private $encoding;

    /**
     * @var int
     */
    private $count;

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return null === ($this->str[0] ?? null);
    }

    /**
     * @return bool
     */
    public function isBlank(): bool
    {
        return $this->trim()->isEmpty();
    }

    /**
     * @return int
     */
    public function count(): int
    {
        if (null !== $this->count) {
            return $this->count;
        }

        if ($this->isEmpty()) {
            $this->count = 0;
            return $this->count;
        }

        $this->count = $this->isMultibyte() ? \mb_strlen($this->str) : \strlen($this->str);
        return $this->count;
    }

    /**
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function hasUpperCase(): bool
    {
        return $this->against('/.*[[:upper:]]/u')->hasMatches();
    }

    /**
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function isUpperCase(): bool
    {
        return $this->against('/^[[:upper:]]*$/u')->hasMatches();
    }

    /**
     * @return Violin
     */
    public function toUpperCase(): self
    {
        return $this->isMultibyte() ? $this->fork(\mb_strtoupper($this->str), $this->encoding) : $this->fork(\strtoupper($this->str), $this->encoding);
    }

    /**
     * @return Violin
     */
    public function upperCaseFirst(): self
    {
        return $this->fork($this->first()->toUpperCase() . $this->last(\count($this) - 1));
    }

    /**
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function hasLowerCase(): bool
    {
        return $this->against('/.*[[:lower:]]/u')->hasMatches();
    }

    /**
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function isLowerCase(): bool
    {
        return $this->against('/^[[:lower:]]*$/u')->hasMatches();
    }

    /**
     * @return Violin
     */
    public function toLowerCase(): self
    {
        return $this->isMultibyte() ? $this->fork(\mb_strtolower($this->str), $this->encoding) : $this->fork(\strtolower($this->str), $this->encoding);
    }

    /**
     * @return Violin
     */
    public function lowerCaseFirst(): self
    {
        return $this->fork($this->first()->toLowerCase() . $this->last(\count($this) - 1));
    }

    /**
     * @return Violin
     */
    public function toPascalCase(): self
    {
        return $this->toCamelCase()->upperCaseFirst();
    }

    /**
     * @return Violin
     */
    public function toUpperCamelCase(): self
    {
        return $this->toPascalCase();
    }

    /**
     * @param bool $screaming
     * @return Violin
     * @throws \InvalidArgumentException
     */
    public function toSnakeCase(bool $screaming = false): self
    {
        return true === $screaming ? $this->delimit('_')->toUpperCase() : $this->delimit('_');
    }

    /**
     * @param bool $screaming
     * @return Violin
     * @throws \InvalidArgumentException
     */
    public function toUnderscoreCase(bool $screaming = false): self
    {
        return $this->toSnakeCase($screaming);
    }

    /**
     * @param bool $screaming
     * @return Violin
     * @throws \InvalidArgumentException
     */
    public function toHyphenCase(bool $screaming = false): self
    {
        return true === $screaming ? $this->delimit('-')->toUpperCase() : $this->delimit('-');
    }

    /**
     * @param bool $screaming
     * @return Violin
     * @throws \InvalidArgumentException
     */
    public function toDashCase(bool $screaming = false): self
    {
        return $this->toHyphenCase($screaming);
    }

    /**
     * @param bool $screaming
     * @return Violin
     * @throws \InvalidArgumentException
     */
    public function toKebabCase(bool $screaming = false): self
    {
        return $this->toHyphenCase($screaming);
    }

    /**
     * @return Violin
     */
    public function toCamelCase(): self
    {
        $encoding = $this->encoding;
        $str = $this->trim();
        $str->str = \preg_replace('/^[-_]+/', '', $str->str);

        $str->str = \preg_replace_callback(
            '/[-_\s]+(.)?/u',
            function ($match) use ($encoding) {
                if (isset($match[1])) {
                    return (string) $this->fork($match[1], $encoding)->toUpperCase();
                }

                return '';
            },
            $str->str
        );

        $str->str = \preg_replace_callback(
            '/[\d]+(.)?/u',
            function ($match) use ($encoding) {
                return (string) $this->fork($match[0], $encoding)->toUpperCase();
            },
            $str->str
        );

        return $str->lowerCaseFirst();
    }

    /**
     * @param int      $start
     * @param int|null $length
     * @return Violin
     */
    public function substr(int $start, int $length = null): self
    {
        $length = $length ?? \count($this);
        return $this->isMultibyte() ? $this->fork(\mb_substr($this->str, $start, $length)) : $this->fork(\substr($this->str, $start, $length));
    }

    /**
     * @param      $separator
     * @param bool $include
     * @return Violin|null
     */
    public function substringAfterFirst($separator, bool $include = false): ?self
    {
        if (false === ($offset = $this->indexOf($separator))) {
            return null;
        }

        $substr = $this->substr($offset, \count($this) - $offset);
        if (false === $include) {
            return $substr->removeLeft($separator);
        }
        return $substr;
    }

    /**
     * @param      $separator
     * @param bool $include
     * @return Violin|null
     * @throws \InvalidArgumentException
     */
    public function substringAfterLast($separator, bool $include = false): ?self
    {
        if (false === ($from = $this->indexOfLast($separator))) {
            return null;
        }

        if (false === $include) {
            $from = $from + \count(self::tune($separator));
        }
        return $this->substr($from, \count($this) - $from);
    }

    /**
     * @param      $separator
     * @param bool $include
     * @return Violin|null
     * @throws \InvalidArgumentException
     */
    public function substringBeforeFirst($separator, bool $include = false): ?self
    {
        if (false === ($from = $this->indexOf($separator))) {
            return null;
        }

        if (true === $include) {
            $from = $from + \count(self::tune($separator));
        }

        return $this->substr(0, $from);
    }

    /**
     * @param      $separator
     * @param bool $include
     * @return Violin|null
     * @throws \InvalidArgumentException
     */
    public function substringBeforeLast($separator, bool $include = false): ?self
    {
        if (false === ($from = $this->indexOfLast($separator))) {
            return null;
        }

        if (true === $include) {
            $from = $from + \count(self::tune($separator));
        }

        return $this->substr(0, $from);
    }

    /**
     * @param int $numberOfChars
     * @return Violin
     */
    public function first(int $numberOfChars = 1): self
    {
        return $this->substr(0, $numberOfChars);
    }

    /**
     * @param int $numberOfChars
     * @return Violin
     */
    public function last(int $numberOfChars = 1): self
    {
        return $this->substr(-$numberOfChars);
    }

    /**
     * @param $str
     * @return bool
     */
    public function startsWith($str): bool
    {
        $str = self::tune($str);
        return (string) $this->substr(0, \count($str)) === (string) $str;
    }

    /**
     * @param iterable $strings
     * @return bool
     */
    public function startsWithAny(iterable $strings): bool
    {
        foreach ($strings as $string) {
            if ($this->startsWith($string)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $str
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function endsWith($str): bool
    {
        $str = self::tune($str);
        return $this->indexOfLast($str) === (\count($this) - \count($str));
    }

    /**
     * @param iterable $strings
     * @return bool
     */
    public function endsWithAny(iterable $strings): bool
    {
        foreach ($strings as $string) {
            if ($this->endsWith($string)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $str
     * @return Violin
     */
    public function ensureLeft($str): self
    {
        if ($this->startsWith($str)) {
            return $this;
        }

        return $this->fork($str . $this);
    }

    /**
     * @param $str
     * @return Violin
     */
    public function ensureRight($str): self
    {
        if ($this->endsWith($str)) {
            return $this;
        }

        return $this->fork($this . $str);
    }

    /**
     * @param $str
     * @return Violin
     */
    public function removeLeft($str): self
    {
        if ($this->startsWith($str)) {
            return $this->last(-\count(self::tune($str)));
        }

        return $this;
    }

    /**
     * @param $str
     * @return Violin
     */
    public function removeRight($str): self
    {
        if ($this->endsWith($str)) {
            return $this->first(-\count(self::tune($str)));
        }

        return $this;
    }

    /**
     * @param string $charlist
     * @return Violin
     */
    public function trim(string $charlist = " \t\n\r\0\x0B"): self
    {
        return $this->fork(\trim($this->str, $charlist));
    }

    /**
     * @param string $charlist
     * @return Violin
     */
    public function trimLeft(string $charlist = " \t\n\r\0\x0B"): self
    {
        return $this->fork(\ltrim($this->str, $charlist));
    }

    /**
     * @param string $charlist
     * @return Violin
     */
    public function trimRight(string $charlist = " \t\n\r\0\x0B"): self
    {
        return $this->fork(\rtrim($this->str, $charlist));
    }

    /**
     * @param string $str
     * @return Violin
     */
    public function append(string $str): self
    {
        return $this->fork($this . $str);
    }

    /**
     * @param string $str
     * @return Violin
     */
    public function prepend(string $str): self
    {
        return $this->fork($str . $this);
    }

    /**
     * @return Violin
     */
    public function reverse(): self
    {
        if (!$this->isMultibyte()) {
            return $this->fork(\strrev($this->str));
        }

        $reversed = '';
        for ($offset = \count($this); $offset >= 0; $offset--) {
            $reversed .= \mb_substr($this->str, $offset, 1);
        }
        return $this->fork($reversed, $this->encoding);
    }

    /**
     * @param string $needle
     * @param int    $offset
     * @param bool   $caseSensitive
     * @return bool|int
     */
    public function indexOf(string $needle, int $offset = 0, bool $caseSensitive = true)
    {
        if (false === $caseSensitive) {
            return $this->isMultibyte() ? \mb_stripos($this->str, $needle, $offset) : \stripos($this->str, $needle, $offset);
        }
        return $this->isMultibyte() ? \mb_strpos($this->str, $needle, $offset) : \strpos($this->str, $needle, $offset);
    }

    /**
     * @param string $needle
     * @param int    $offset
     * @return bool|int
     */
    public function indexOfLast(string $needle, int $offset = 0, bool $caseSensitive = false)
    {
        if (false === $caseSensitive) {
            return $this->isMultibyte() ? \mb_strripos($this->str, $needle, $offset) : \strripos($this->str, $needle, $offset);
        }
        return $this->isMultibyte() ? \mb_strrpos($this->str, $needle, $offset) : \strrpos($this->str, $needle, $offset);
    }

    /**
     * @param string $needle
     * @param bool   $caseSensitive
     * @return bool
     */
    public function contains(string $needle, bool $caseSensitive = false): bool
    {
        return false !== $this->indexOf($needle, 0, $caseSensitive);
    }

    /**
     * @param iterable $needles
     * @param bool     $caseSensitive
     * @return bool
     */
    public function containsAny(iterable $needles, bool $caseSensitive = false): bool
    {
        foreach ($needles as $needle) {
            if (true === $this->contains($needle, $caseSensitive)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param iterable $needles
     * @param bool     $caseSensitive
     * @return bool
     */
    public function containsAll(iterable $needles, bool $caseSensitive = false): bool
    {
        foreach ($needles as $needle) {
            $hasLooped = true;
            if (false === $this->contains($needle, $caseSensitive)) {
                return false;
            }
        }

        return $hasLooped ?? false;
    }

    /**
     * @param array $pairs
     * @return Violin
     * @throws \InvalidArgumentException
     */
    public function replaceWithPairs(array $pairs): self
    {
        return self::tune(\strtr($this->str, $pairs));
    }

    /**
     * @param string|null $locale
     * @param string      $replaceUnsupportedBy
     * @return Violin
     */
    public function toAscii(string $locale = null, string $replaceUnsupportedBy = ''): self
    {
        if (self::ASCII === $this->getEncoding()) {
            return $this;
        }

        return $this->fork(AsciiConverter::convert($this->str, $locale, $replaceUnsupportedBy), self::ASCII);
    }

    /**
     * @param $pattern
     * @return RegularExpressionHandler
     * @throws \InvalidArgumentException
     */
    public function against($pattern): Regex
    {
        return Regex::make($pattern, $this);
    }

    /**
     * @return Violin
     * @throws \InvalidArgumentException
     */
    public function collapseWhitespace(): self
    {
        return $this->against('/[[:space:]]+/')->replaceWith(' ');
    }

    /**
     * @param string $delimiter
     * @return Violin
     * @throws \InvalidArgumentException
     */
    public function delimit(string $delimiter): self
    {
        return $this
            ->trim()
            ->against('/\B([A-Z])/u')->replaceWith('-\1')
            ->toLowerCase()
            ->against('/[-_\s]+/u')->replaceWith($delimiter)
            ;
    }

    /**
     * @param string      $delimiter
     * @param string|null $locale
     * @param null|string $replaceUnsupportedBy
     * @return Violin
     */
    public function slugify(string $delimiter, string $locale = null, ?string $replaceUnsupportedBy = ''): self
    {
        $str = $this->toAscii($locale, $replaceUnsupportedBy);
        $str->str = \strtr($str->str, ['@' => $delimiter]);
        $pattern = '/[^a-zA-Z\d\s' . \preg_quote($delimiter, '/') . ']/u';
        $str->str = \preg_replace($pattern, '', $str);
        return $str->toLowerCase()->delimit($delimiter)->removeLeft($delimiter)->removeRight($delimiter);
    }

    /**
     * @param string $str
     * @param string $separator
     * @return Violin
     */
    public function surround(string $str, string $separator = ''): self
    {
        return $this->fork($str . $separator . $this . $separator . $str);
    }

    /**
     * @return Violin
     */
    public function tidy(): self
    {
        $str = \preg_replace([
            '/\x{2026}/u',
            '/[\x{201C}\x{201D}]/u',
            '/[\x{2018}\x{2019}]/u',
            '/[\x{2013}\x{2014}]/u',
        ], [
            '...',
            '"',
            "'",
            '-',
        ], $this->str);

        return $this->fork($str);
    }

    /**
     * @param int    $totalLength
     * @param string $endWith
     * @param bool   $safe
     * @return Violin
     * @throws \InvalidArgumentException
     */
    public function truncate(int $totalLength, string $endWith = '...', bool $safe = false): self
    {
        $cnt = \count($this);
        if ($cnt <= $totalLength) {
            return $this;
        }

        $substr = $this->first($totalLength - \count(self::tune($endWith)));

        if (true === $safe && $this->indexOf(' ') !== $totalLength) {
            $lastPos = $substr->indexOfLast(' ');
            if (false !== $lastPos) {
                $substr = $this->first($lastPos);
            }
        }

        return $this->fork($substr . $endWith);
    }


    /**
     * Violin constructor disabled - use the tune() static method instead.
     * Instanciating from a clone instead of new Violin() is about 3x faster.
     */
    private function __construct()
    {
    }

    /**
     * @param $str
     * @return Violin
     * @throws \InvalidArgumentException
     */
    public static function tune($str): self
    {
        if ($str instanceof Violin) {
            return $str;
        }

        if (!self::isStringable($str)) {
            throw new \InvalidArgumentException(
                \sprintf('Expected stringable object, got %s', \is_object($str) ? \get_class($str) : \gettype($str))
            );
        }

        static $v;
        if (!isset($v)) {
            $v = new self;
            $v->str = (string) $str;
            return $v;
        }
        $v = clone $v;
        $v->str = (string) $str;
        $v->encoding = null;
        $v->count = null;
        return $v;
    }

    /**
     * @param $str
     * @return bool
     */
    public static function isStringable($str): bool
    {
        if (\is_string($str) || \is_numeric($str) || null === $str) {
            return true;
        }

        if (\is_object($str) && \is_callable([$str, '__toString'])) {
            return true;
        }

        return false;
    }

    /**
     * @param string      $str
     * @param string|null $encoding
     * @return Violin
     */
    private function fork(string $str, string $encoding = null): self
    {
        $v = self::tune($str);
        $v->encoding = $encoding;
        return $v;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->str;
    }

    /**
     * @param string $str
     * @param string $encoding
     * @return bool
     */
    public static function isEncodingValid(string $str, string $encoding): bool
    {
        return \mb_check_encoding($str, $encoding);
    }

    /**
     * @return string
     */
    public function getEncoding(): string
    {
        if (null === $this->encoding) {
            $this->encoding = \mb_detect_encoding($this->str);
        }
        return $this->encoding;
    }

    /**
     * @return bool
     */
    private function isMultibyte(): bool
    {
        if (null !== $this->encoding) {
            return self::ASCII !== $this->encoding;
        }

        if (0 === preg_match('/[^\x20-\x7f]/', $this->str)) {
            $this->encoding = self::ASCII;
            return false;
        }

        return true;
    }
}
