<?php

namespace BenTools\Violin\Tests;

use BenTools\Violin\Violin;
use PHPUnit\Framework\TestCase;

final class SubstrTest extends TestCase
{
    /**
     * @dataProvider substrDataset
     */
    public function testSubstr(string $string, int $start, ?int $length, string $expected)
    {
        $v = Violin::tune($string)->substr($start, $length);
        $this->assertEquals($expected, (string) $v);
    }

    public function substrDataset()
    {
        yield ['foobar', 0, 3, 'foo'];
        yield ['foobar', 1, 3, 'oob'];
        yield ['foobar', 1, null, 'oobar'];
        yield ['foobar', -1, null, 'r'];
        yield ['fòôbàř', 0, 3, 'fòô'];
        yield ['fòôbàř', 1, 3, 'òôb'];
        yield ['fòôbàř', 1, null, 'òôbàř'];
        yield ['fòôbàř', -1, null, 'ř'];
    }

    /**
     * @dataProvider firstDataset
     */
    public function testFirst(string $string, ?int $length, string $expected)
    {
        $v = Violin::tune($string)->first($length);
        $this->assertEquals($expected, (string) $v);
    }

    public function firstDataset()
    {
        yield ['foobar', 3, 'foo'];
        yield ['foobar', 0, ''];
        yield ['foobar', -2, 'foob'];
        yield ['fòôbàř', 3, 'fòô'];
        yield ['fòôbàř', 0, ''];
        yield ['fòôbàř', -2, 'fòôb'];
    }

    /**
     * @dataProvider lastDataset
     */
    public function testLast(string $string, ?int $length, string $expected)
    {
        $v = Violin::tune($string)->last($length);
        $this->assertEquals($expected, (string) $v);
    }

    public function lastDataset()
    {
        yield ['foobar', 3, 'bar'];
        yield ['foobar', 0, 'foobar'];
        yield ['foobar', -2, 'obar'];
        yield ['fòôbàř', 3, 'bàř'];
        yield ['fòôbàř', 0, 'fòôbàř'];
        yield ['fòôbàř', -2, 'ôbàř'];
    }

    public function testStartsWith()
    {
        $this->assertTrue(Violin::tune('foobar')->startsWith('foo'));
        $this->assertFalse(Violin::tune('foobar')->startsWith('bar'));
        $this->assertFalse(Violin::tune('foobar')->startsWith('fòô'));
        $this->assertTrue(Violin::tune('fòôbàř')->startsWith('fòô'));
        $this->assertFalse(Violin::tune('fòôbàř')->startsWith('foo'));
    }

    public function testEndsWith()
    {
        $this->assertTrue(Violin::tune('foobar')->endsWith('bar'));
        $this->assertFalse(Violin::tune('foobar')->endsWith('foo'));
        $this->assertFalse(Violin::tune('foobar')->endsWith('bàř'));
        $this->assertTrue(Violin::tune('fòôbàř')->endsWith('bàř'));
        $this->assertFalse(Violin::tune('fòôbàř')->endsWith('bar'));
    }

    public function testEnsureLeft()
    {
        $this->assertEquals('foobar', (string) Violin::tune('bar')->ensureLeft('foo'));
        $this->assertEquals('foobar', (string) Violin::tune('foobar')->ensureLeft('foo'));
        $this->assertEquals('foofoobar', (string) Violin::tune('foofoobar')->ensureLeft('foo'));
        $this->assertEquals('fòôbar', (string) Violin::tune('bar')->ensureLeft('fòô'));
        $this->assertEquals('fòôbar', (string) Violin::tune('fòôbar')->ensureLeft('fòô'));
        $this->assertEquals('foofòôbar', (string) Violin::tune('fòôbar')->ensureLeft('foo'));
    }

    public function testEnsureRight()
    {
        $this->assertEquals('foobar', (string) Violin::tune('foo')->ensureRight('bar'));
        $this->assertEquals('foobar', (string) Violin::tune('foobar')->ensureRight('bar'));
        $this->assertEquals('foobarbar', (string) Violin::tune('foobarbar')->ensureRight('bar'));
        $this->assertEquals('foobàř', (string) Violin::tune('foo')->ensureRight('bàř'));
        $this->assertEquals('fòôbàř', (string) Violin::tune('fòôbàř')->ensureRight('bàř'));
        $this->assertEquals('fòôbarbàř', (string) Violin::tune('fòôbar')->ensureRight('bàř'));
    }

    public function testRemoveLeft()
    {
        $this->assertEquals('bar', (string) Violin::tune('foobar')->removeLeft('foo'));
        $this->assertEquals('foobar', (string) Violin::tune('foobar')->removeLeft('bar'));
        $this->assertEquals('bàř', (string) Violin::tune('fòôbàř')->removeLeft('fòô'));
        $this->assertEquals('fòôbàř', (string) Violin::tune('fòôbàř')->removeLeft('foo'));
    }

    public function testRemoveRight()
    {
        $this->assertEquals('foo', (string) Violin::tune('foobar')->removeRight('bar'));
        $this->assertEquals('foobar', (string) Violin::tune('foobar')->removeRight('foo'));
        $this->assertEquals('fòô', (string) Violin::tune('fòôbàř')->removeRight('bàř'));
        $this->assertEquals('fòôbàř', (string) Violin::tune('fòôbàř')->removeRight('fòô'));
    }

    public function testSubstringAfterFirst()
    {
        $this->assertNull(Violin::tune('/foo🤗/bar🤗/baz')->substringAfterFirst('x'));
        $this->assertEquals('/bar🤗/baz', (string) Violin::tune('/foo🤗/bar🤗/baz')->substringAfterFirst('🤗'));
        $this->assertEquals('🤗/bar🤗/baz', (string) Violin::tune('/foo🤗/bar🤗/baz')->substringAfterFirst('🤗', true));
        $this->assertEquals('/bar🤗/baz', (string) Violin::tune('/foo🤗/bar🤗/baz')->substringAfterFirst('🤗', false));
    }

    public function testSubstringAfterLast()
    {
        $this->assertNull(Violin::tune('/foo🤗/bar🤗/baz')->substringAfterLast('x'));
        $this->assertEquals('/baz', (string) Violin::tune('/foo🤗/bar🤗/baz')->substringAfterLast('🤗'));
        $this->assertEquals('🤗/baz', (string) Violin::tune('/foo🤗/bar🤗/baz')->substringAfterLast('🤗', true));
        $this->assertEquals('/baz', (string) Violin::tune('/foo🤗/bar🤗/baz')->substringAfterLast('🤗', false));
    }

    public function testSubstringBeforeFirst()
    {
        $this->assertNull(Violin::tune('/foo🤗/bar🤗/baz')->substringBeforeFirst('x'));
        $this->assertEquals('/foo', (string) Violin::tune('/foo🤗/bar🤗/baz')->substringBeforeFirst('🤗'));
        $this->assertEquals('/foo🤗', (string) Violin::tune('/foo🤗/bar🤗/baz')->substringBeforeFirst('🤗', true));
        $this->assertEquals('/foo', (string) Violin::tune('/foo🤗/bar🤗/baz')->substringBeforeFirst('🤗', false));
    }

    public function testSubstringBeforeLast()
    {
        $this->assertNull(Violin::tune('/foo🤗/bar🤗/baz')->substringBeforeLast('x'));
        $this->assertEquals('/foo🤗/bar', (string) Violin::tune('/foo🤗/bar🤗/baz')->substringBeforeLast('🤗'));
        $this->assertEquals('/foo🤗/bar🤗', (string) Violin::tune('/foo🤗/bar🤗/baz')->substringBeforeLast('🤗', true));
        $this->assertEquals('/foo🤗/bar', (string) Violin::tune('/foo🤗/bar🤗/baz')->substringBeforeLast('🤗', false));
    }

    public function testTruncate()
    {
        $this->assertEquals('🤗 Il était u...', (string) Violin::tune('🤗 Il était une fois')->truncate(15, '...'));
        $this->assertEquals('🤗 Il était...', (string) Violin::tune('🤗 Il était une fois')->truncate(15, '...', true));
    }
}
