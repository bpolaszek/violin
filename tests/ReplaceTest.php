<?php

namespace BenTools\Violin\Tests;

use BenTools\Violin\Violin;
use PHPUnit\Framework\TestCase;

final class ReplaceTest extends TestCase
{

    public function testReplaceWithPairs()
    {
        $this->assertEquals('bob', (string) Violin::tune('lol')->replaceWithPairs(['l' => 'b']));
        $this->assertEquals('😂😂😂😂🤗', (string) Violin::tune('🤗🤗😂😂🤗')->replaceWithPairs(['🤗🤗' => '😂😂']));
    }

    public function testTidy()
    {
        $this->assertEquals('"Il est là..."', Violin::tune('“Il est là…”')->tidy());
    }
}
