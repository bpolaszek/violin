<?php

namespace BenTools\Violin\Tests;

use BenTools\Violin\Violin;
use PHPUnit\Framework\TestCase;

final class PositionTest extends TestCase
{

    public function testIndexOf()
    {
        $this->assertEquals(false, Violin::tune('foo🤗bar🤗')->indexOf('x'));
        $this->assertEquals(0, Violin::tune('foo🤗bar🤗')->indexOf('f'));
        $this->assertEquals(4, Violin::tune('foo🤗bar🤗')->indexOf('b'));
        $this->assertEquals(1, Violin::tune('foo🤗bar🤗')->indexOf('o'));
        $this->assertEquals(3, Violin::tune('foo🤗bar🤗')->indexOf('🤗'));
    }

    public function testIndexOfLast()
    {
        $this->assertEquals(false, Violin::tune('foo🤗bar🤗')->indexOfLast('x'));
        $this->assertEquals(0, Violin::tune('foo🤗bar🤗')->indexOfLast('f'));
        $this->assertEquals(4, Violin::tune('foo🤗bar🤗')->indexOfLast('b'));
        $this->assertEquals(2, Violin::tune('foo🤗bar🤗')->indexOfLast('o'));
        $this->assertEquals(7, Violin::tune('foo🤗bar🤗')->indexOfLast('🤗'));
    }

    public function testContains()
    {
        $this->assertFalse(Violin::tune('foo🤗bar🤗')->contains('x'));
        $this->assertTrue(Violin::tune('foo🤗bar🤗')->contains('🤗'));
        $this->assertFalse(Violin::tune('foo🤗bar🤗')->contains('🤗🤗'));
    }

    public function testContainsAny()
    {
        $this->assertFalse(Violin::tune('foo🤗bar🤗')->containsAny(['x']));
        $this->assertTrue(Violin::tune('foo🤗bar🤗')->containsAny(['x', '🤗']));
        $this->assertTrue(Violin::tune('foo🤗bar🤗')->containsAny(['x', '🤗', '🤗🤗']));
        $this->assertFalse(Violin::tune('foo🤗bar🤗')->containsAny(['x', '🤗🤗']));
    }

    public function testContainAll()
    {
        $this->assertFalse(Violin::tune('foo🤗bar🤗')->containsAll(['x']));
        $this->assertFalse(Violin::tune('foo🤗bar🤗')->containsAll(['x', '🤗']));
        $this->assertFalse(Violin::tune('foo🤗bar🤗')->containsAll(['x', '🤗', '🤗🤗']));
        $this->assertTrue(Violin::tune('foo🤗bar🤗')->containsAll(['foo', '🤗', 'bar']));
        $this->assertTrue(Violin::tune('foo🤗bar🤗')->containsAll(['bar', '🤗']));
    }
}
