<?php

namespace AppBundle\Tests;

use AppBundle\Util\StringGenerator;
use PHPUnit\Framework\TestCase;

class StringGeneratorTest extends TestCase
{
    private $stringGenerator;

    protected function setUp()
    {
        $this->stringGenerator = new StringGenerator();
    }

    protected function tearDown()
    {
        $this->stringGenerator = null;
    }

    public function testStringGeneratedSize()
    {
        $length = 110;

        $this->assertEquals($length, strlen($this->stringGenerator->getRandomString($length)));
    }
}
