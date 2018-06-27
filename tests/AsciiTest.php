<?php

namespace BenTools\Violin\Tests;

use function BenTools\Violin\string;
use PHPUnit\Framework\TestCase;

final class AsciiTest extends TestCase
{

    public function testAsciiConversion()
    {
        $this->assertEquals('foobar', (string) string('fòöbàř🤗')->toAscii());
        $this->assertEquals('fooebar', (string) string('fòöbàř🤗')->toAscii('de-DE'));
        $this->assertEquals('fooebar:happy:', (string) string('fòöbàř🤗')->toAscii('DE', ':happy:'));
    }

}
