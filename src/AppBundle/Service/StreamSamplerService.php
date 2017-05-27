<?php

namespace AppBundle\Service;

/**
 * Class StreamSamplerService
 * @package AppBundle\Service
 */
class StreamSamplerService implements StreamSamplerInterface
{

    /**
     * @param string $stream
     * @param integer $sampleSize
     * @return string
     */
    public function getSample($stream, $sampleSize)
    {
        $sample = '';
        $max = strlen($stream) - 1;

        for ($count = 0; $count < $sampleSize; $count++) {
            $position = random_int($count, $max);
            $sample .= $stream[$position];
        }

        return $sample;
    }
}
