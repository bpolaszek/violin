<?php

namespace BenTools\Violin;

/**
 * Class RegularExpressionHandler
 * @internal
 */
final class RegularExpressionHandler
{
    /**
     * @var string
     */
    private $pattern;

    /**
     * @var Violin
     */
    private $str;

    private function __construct()
    {
    }

    /**
     * @param      $pattern
     * @param bool $ensureUtf8Compatible
     * @return RegularExpressionHandler
     * @throws \InvalidArgumentException
     */
    public static function make($pattern, Violin $str)
    {
        static $prototype;

        if (!isset($prototype)) {
            $prototype = new self;
        } else {
            $prototype = clone $prototype;
        }

        $delimiter = $pattern[0];
        $delimiterPos = \strrpos($pattern, $delimiter);
        $modifiers = \substr($pattern, $delimiterPos + \strlen($delimiter), \strlen($pattern));
        if (false === \strpos($modifiers, 'u')) {
            $pattern = $pattern . 'u';
        }

        $prototype->pattern = $pattern;
        $prototype->str = $str;
        return $prototype;
    }

    /**
     * @return bool
     */
    public function hasMatches(): bool
    {
        return 0 < \preg_match($this->pattern, $this->str);
    }

    /**
     * @return array
     */
    public function findMatches(): array
    {
        \preg_match($this->pattern, $this->str, $matches);
        return $matches;
    }

    /**
     * @return array
     */
    public function findAllMatches(): array
    {
        \preg_match_all($this->pattern, $this->str, $matches);
        return $matches;
    }

    /**
     * @param          $replacement
     * @param int      $limit
     * @param int|null $count
     * @return Violin
     * @throws \InvalidArgumentException
     */
    public function replaceWith($replacement, int $limit = -1, int &$count = null): Violin
    {
        return Violin::tune(\preg_replace($this->pattern, $replacement, $this->str, $limit, $count));
    }

    /**
     * @param callable $callback
     * @param int      $limit
     * @param int|null $count
     * @return Violin
     * @throws \InvalidArgumentException
     */
    public function replaceWithCallback(callable $callback, int $limit = -1, int &$count = null): Violin
    {
        return Violin::tune(\preg_replace_callback($this->pattern, $callback, $this->str, $limit, $count));
    }
}
