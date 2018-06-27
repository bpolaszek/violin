<?php

namespace BenTools\Violin\Tests;

use PHPUnit\Framework\TestCase;
use function BenTools\Violin\string;

final class ConcatTest extends TestCase
{

    public function testAppend()
    {
        $this->assertEquals('foobar', (string) string('foo')->append('bar'));
        $this->assertEquals('🤗😂', (string) string('🤗')->append('😂'));
    }

    public function testPrepend()
    {
        $this->assertEquals('barfoo', (string) string('foo')->prepend('bar'));
        $this->assertEquals('😂🤗', (string) string('🤗')->prepend('😂'));
    }

}
