<?php

namespace BenTools\Violin\Tests;

use BenTools\Violin\Violin;
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


    public function testSurround()
    {
        $this->assertEquals('😂 foobar 😂', Violin::tune('foobar')->surround('😂', ' '));
    }
}
