<?php

namespace BenTools\Violin\Tests;

use BenTools\Violin\Violin;
use PHPUnit\Framework\TestCase;

final class ReverseTest extends TestCase
{
    public function testReverse()
    {
        $this->assertEquals('raboof', Violin::tune('foobar')->reverse());
        $this->assertEquals('🤗raboof😂', Violin::tune('😂foobar🤗')->reverse());
        $this->assertEquals('kayak', Violin::tune('kayak')->reverse()); // lol
    }

}
