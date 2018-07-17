<?php

namespace BenTools\Violin\Tests;

use BenTools\Violin\Violin;
use PHPUnit\Framework\TestCase;

final class TrimTest extends TestCase
{


    public function testTrim()
    {
        $this->assertEquals('foo', (string) Violin::tune(' foo ')->trim());
        $this->assertEquals('foo', (string) Violin::tune('foo ')->trim());
        $this->assertEquals('foo', (string) Violin::tune(' foo')->trim());
        $this->assertEquals('foo', (string) Violin::tune("foo\t")->trim());
        $this->assertEquals('|foo|', (string) Violin::tune('|foo|')->trim());
        $this->assertEquals('foo', (string) Violin::tune('|foo|')->trim('|'));
        $this->assertEquals('🤗foo🤗bar🤗', (string) Violin::tune('🤗foo🤗bar🤗')->trim());
        $this->assertEquals('foo🤗bar', (string) Violin::tune('🤗foo🤗bar🤗')->trim('🤗'));
    }

    public function testTrimLeft()
    {
        $this->assertEquals('foo ', (string) Violin::tune(' foo ')->trimLeft());
        $this->assertEquals('foo ', (string) Violin::tune('foo ')->trimLeft());
        $this->assertEquals('foo', (string) Violin::tune(' foo')->trimLeft());
        $this->assertEquals("foo\t", (string) Violin::tune("foo\t")->trimLeft());
        $this->assertEquals("foo\t", (string) Violin::tune("\tfoo\t")->trimLeft());
        $this->assertEquals('|foo|', (string) Violin::tune('|foo|')->trimLeft());
        $this->assertEquals('foo|', (string) Violin::tune('foo|')->trimLeft('|'));
        $this->assertEquals('🤗foo🤗bar🤗', (string) Violin::tune('🤗foo🤗bar🤗')->trimLeft());
        $this->assertEquals('foo🤗bar🤗', (string) Violin::tune('🤗foo🤗bar🤗')->trimLeft('🤗'));
    }


    public function testTrimRight()
    {
        $this->assertEquals(' foo', (string) Violin::tune(' foo ')->trimRight());
        $this->assertEquals('foo', (string) Violin::tune('foo ')->trimRight());
        $this->assertEquals(' foo', (string) Violin::tune(' foo')->trimRight());
        $this->assertEquals('foo', (string) Violin::tune("foo\t")->trimRight());
        $this->assertEquals("\tfoo", (string) Violin::tune("\tfoo\t")->trimRight());
        $this->assertEquals('|foo|', (string) Violin::tune('|foo|')->trimRight());
        $this->assertEquals('|foo', (string) Violin::tune('|foo|')->trimRight('|'));
        $this->assertEquals('🤗foo🤗bar🤗', (string) Violin::tune('🤗foo🤗bar🤗')->trimRight());
        $this->assertEquals('🤗foo🤗bar', (string) Violin::tune('🤗foo🤗bar🤗')->trimRight('🤗'));
    }

    public function testCollapseWhitespace()
    {
        $this->assertEquals('foo bar', (string) Violin::tune('foo         bar')->collapseWhitespace());
        $this->assertEquals('foo bar', (string) Violin::tune("foo\t\t\n\r\tbar")->collapseWhitespace());
    }
}
