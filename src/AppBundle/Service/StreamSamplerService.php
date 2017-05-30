<?php

namespace AppBundle\Service;

/**
 * Class StreamSamplerService
 * @package AppBundle\Service
 */
class StreamSamplerService implements StreamSamplerInterface
{
    const RANDOM_GENERATOR_LOWER_LIMIT = 0,
        STREAMING_CHUNKS_LENGTH = 1024,
        FILE_NAME = 'stream.txt',
        FILE_PATH = __DIR__ .
            DIRECTORY_SEPARATOR . ".." .
            DIRECTORY_SEPARATOR . ".." .
            DIRECTORY_SEPARATOR . ".." .
            DIRECTORY_SEPARATOR . 'web/data/files' .
            DIRECTORY_SEPARATOR;

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
            $position = random_int(self::RANDOM_GENERATOR_LOWER_LIMIT, $max);
            $sample .= $stream[$position];
        }

        return $sample;
    }

    public function getSampleFromFile($sampleSize)
    {
        $sample = '';
        $file = self::FILE_PATH .
            self::FILE_NAME;

        $sampleSizePerChunk = $this->getSampleSizePerChunk($file);

        $fileHandle = @fopen($file, "r");

        if ($fileHandle) {
            while (($streamChunk = fgets($fileHandle, self::STREAMING_CHUNKS_LENGTH)) !== false || strlen($sample) < $sampleSize) {
                $sample .= $this->getSample($streamChunk, $sampleSizePerChunk);
            }

            if (!feof($fileHandle) && strlen($sample) < $sampleSize) {
                throw new \Exception('Unexpected streaming file EOF');
            }

            fclose($fileHandle);
        }

        return $sample;
    }

    /**
     * @param $file
     * @return integer
     */
    private function getSampleSizePerChunk($file)
    {
        return intval(filesize($file) / self::STREAMING_CHUNKS_LENGTH);
    }
}
