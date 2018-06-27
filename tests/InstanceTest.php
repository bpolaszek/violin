<?php

namespace BenTools\Violin\Tests;

use BenTools\Violin\Violin;
use PHPUnit\Framework\TestCase;
use function BenTools\Violin\string;

final class InstanceTest extends TestCase
{

    public function testInstanciation()
    {
        $foo = Violin::tune('foo');
        $this->assertInstanceOf(Violin::class, $foo);
        $this->assertEquals('foo', (string) $foo);

        $bar = Violin::tune('bar');
        $this->assertInstanceOf(Violin::class, $bar);
        $this->assertEquals('bar', (string) $bar);

        $this->assertNotSame($foo, $bar);

        $foo2 = Violin::tune($foo);
        $this->assertSame($foo, $foo2);

        $foo3 = Violin::tune((string) $foo);
        $this->assertEquals('foo', (string) $foo3);
        $this->assertNotSame($foo3, $foo);
    }

    public function testFunction()
    {
        $foo = string('foo');
        $this->assertInstanceOf(Violin::class, $foo);

        $bar = string(Violin::tune('bar'));
        $this->assertInstanceOf(Violin::class, $bar);

        $baz = string(new class {
            public function __toString()
            {
                return 'baz';
            }
        });
        $this->assertInstanceOf(Violin::class, $baz);
        $this->assertEquals('baz', (string) $baz);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidString()
    {
        string([]);
    }

    public function testNullString()
    {
        $this->assertEquals('', (string) string(null));
        $this->assertTrue(string(null)->isEmpty());
        $this->assertTrue(string(null)->isBlank());
    }
}
