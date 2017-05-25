<?php

namespace AppBundle\Service;

interface StreamSamplerInterface {
    public function getSample($stream, $sampleSize);
}