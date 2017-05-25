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

        for ($count = 0; $count < $sampleSize; $count++) {
            $sample .= $stream[\random_int(0, strlen($stream))];
        }

        return $sample;
    }
}
