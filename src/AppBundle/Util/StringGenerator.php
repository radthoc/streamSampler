<?php

namespace AppBundle\Util;

/**
 * Class StringGenerator
 * @package AppBundle\Util
 */
class StringGenerator
{
    /**
     * @param integer $length
     * @return string
     */
    function getRandomString($length)
    {
        return bin2hex(random_bytes($length));
    }
}
