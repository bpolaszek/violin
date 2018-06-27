<?php

namespace BenTools\Violin\Tests;

use BenTools\Violin\Violin;
use PHPUnit\Framework\TestCase;

final class ValidationTest extends TestCase
{

    public function testValidEncodings()
    {
        $this->assertTrue(Violin::isEncodingValid('foo', 'ASCII'));
        $this->assertTrue(Violin::isEncodingValid('foo', 'UTF8'));
        $this->assertFalse(Violin::isEncodingValid('fooç', 'ASCII'));
        $this->assertTrue(Violin::isEncodingValid('fooç', 'UTF8'));
    }

}
