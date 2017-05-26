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
        $string = '';

        while (strlen($string) < $length) {
            $string .= $this->getString($length - strlen($string));
        }

        return $string;
    }

    /**
     * @param $length
     * @return string
     */
    private function getString($length)
    {
        $seed = $this->getStringSeed();

        return substr(str_shuffle($seed), 0, $length);
    }

    /**
     * @return array
     */
    private function getStringSeed()
    {
        return implode('', array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9')));
    }
}
