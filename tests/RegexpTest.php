<?php

namespace BenTools\Violin\Tests;

use BenTools\Violin\Violin;
use PHPUnit\Framework\TestCase;

final class RegexpTest extends TestCase
{

    public function testHasMatches()
    {
        $this->assertTrue(Violin::tune(' 🤗 fÒÔ   BÀŘ ')->against('/(🤗)/')->hasMatches());
        $this->assertFalse(Violin::tune(' 🤗 fÒÔ   BÀŘ ')->against('/(😂)/')->hasMatches());
    }

    public function testFindMatches()
    {
        $this->assertEquals('🤗', Violin::tune(' 🤗 fÒÔ   BÀŘ ')->against('/(🤗)/')->findMatches()[1]);
    }

    public function testFindAllMatches()
    {
        $this->assertEquals('🤗', Violin::tune(' 🤗 fÒÔ   BÀŘ ')->against('/(🤗)/')->findAllMatches()[1][0]);
    }

    public function testReplace()
    {
        $this->assertEquals(' 😂 fÒÔ   BÀŘ ', Violin::tune(' 🤗 fÒÔ   BÀŘ ')->against('/(🤗)/')->replaceWith('😂'));
    }

}
