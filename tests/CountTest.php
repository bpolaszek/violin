<?php

namespace BenTools\Violin\Tests;

use BenTools\Violin\Violin;
use PHPUnit\Framework\TestCase;

final class CountTest extends TestCase
{

    public function testEmptyCount()
    {
        $str = Violin::tune('');
        $this->assertCount(0, $str);
    }

    public function testAsciiCount()
    {
        $str = Violin::tune('foo');
        $this->assertCount(3, $str);
    }

    public function testUTF8Count()
    {
        $str = Violin::tune('😀😂');
        $this->assertCount(2, $str);
    }

}
