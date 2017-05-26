<?php

namespace AppBundle\Tests;

use AppBundle\Service\StreamSamplerService;
use PHPUnit\Framework\TestCase;

class StreamSamplerServiceTest extends TestCase
{
    private $streamSamplerService;

    protected function setUp()
    {
        $this->streamSamplerService = new StreamSamplerService();
    }

    protected function tearDown()
    {
        $this->streamSamplerService = null;
    }

    public function testStreamSampleGeneratedSize()
    {
        $stream = 'THEQUICKBROWNFOXJUMPSOVERTHELAZYDOG';
        $sampleSize = 5;

        $this->assertEquals($sampleSize, strlen($this->streamSamplerService->getSample($stream, $sampleSize)));
    }
}
