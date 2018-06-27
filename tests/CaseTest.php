<?php

namespace BenTools\Violin\Tests;

use BenTools\Violin\Violin;
use PHPUnit\Framework\TestCase;
use function BenTools\Violin\strtolower;
use function BenTools\Violin\strtoupper;

final class CaseTest extends TestCase
{

    /**
     * @dataProvider toUpperCaseSet
     */
    public function testToUpperCase($tested, $expected)
    {
        $this->assertEquals((string) strtoupper($expected), strtoupper($tested));
    }

    public function toUpperCaseSet()
    {
        yield ['foobar', 'FOOBAR'];
        yield ['foOBar', 'FOOBAR'];
        yield ['fòôbàř', 'FÒÔBÀŘ'];
    }

    /**
     * @dataProvider toLowerCaseSet
     */
    public function testToLowerCase($tested, $expected)
    {
        $this->assertEquals((string) strtolower($expected), strtolower($tested));
    }

    public function toLowerCaseSet()
    {
        foreach ($this->toUpperCaseSet() as $value) {
            yield array_reverse($value);
        }
    }

    /**
     * @dataProvider upperCaseFirstSet
     */
    public function testUpperCaseFirst($tested, $expected)
    {
        $this->assertEquals((string) strtoupper($expected), strtoupper($tested));
    }

    public function upperCaseFirstSet()
    {
        yield ['Foobar', 'foobar'];
        yield ['Foobar', 'Foobar'];
        yield ['FOOBAR', 'FOOBAR'];
        yield ['Fòôbàř', 'fòôbàř'];
        yield ['Fòôbàř', 'Fòôbàř'];
        yield ['FÒÔBÀŘ', 'FÒÔBÀŘ'];
    }

    /**
     * @dataProvider lowerCaseFirstSet
     */
    public function testLowerCaseFirst($tested, $expected)
    {
        $this->assertEquals((string) strtoupper($expected), strtoupper($tested));
    }

    public function lowerCaseFirstSet()
    {
        yield ['foobar', 'foobar'];
        yield ['foobar', 'Foobar'];
        yield ['fOOBAR', 'FOOBAR'];
        yield ['fòôbàř', 'fòôbàř'];
        yield ['fòôbàř', 'Fòôbàř'];
        yield ['fÒÔBÀŘ', 'FÒÔBÀŘ'];
    }

    /**
     * @dataProvider hasLowerCaseSet
     */
    public function testHasLowerCase($tested, $expected)
    {
        $this->assertEquals($expected, Violin::tune($tested)->hasLowerCase());
    }

    public function hasLowerCaseSet()
    {
        yield ['foo', true];
        yield ['Foo', true];
        yield ['FOO', false];
        yield ['fòô', true];
        yield ['Fòô', true];
        yield ['FÒÔ', false];
    }

    /**
     * @dataProvider hasUpperCaseSet
     */
    public function testHasUpperCase($tested, $expected)
    {
        $this->assertEquals($expected, Violin::tune($tested)->hasUpperCase());
    }

    public function hasUpperCaseSet()
    {
        yield ['foo', false];
        yield ['Foo', true];
        yield ['FOO', true];
        yield ['fòô', false];
        yield ['Fòô', true];
        yield ['FÒÔ', true];
    }

    /**
     * @dataProvider isLowerCaseSet
     */
    public function testIsLowerCase($tested, $expected)
    {
        $this->assertEquals($expected, Violin::tune($tested)->isLowerCase());
    }

    public function isLowerCaseSet()
    {
        yield ['foo', true];
        yield ['Foo', false];
        yield ['FOO', false];
        yield ['fòô', true];
        yield ['Fòô', false];
        yield ['FÒÔ', false];
    }

    /**
     * @dataProvider isUpperCaseSet
     */
    public function testIsUpperCase($tested, $expected)
    {
        $this->assertEquals($expected, Violin::tune($tested)->isUpperCase());
    }

    public function isUpperCaseSet()
    {
        yield ['foo', false];
        yield ['Foo', false];
        yield ['FOO', true];
        yield ['fòô', false];
        yield ['Fòô', false];
        yield ['FÒÔ', true];
    }
}
