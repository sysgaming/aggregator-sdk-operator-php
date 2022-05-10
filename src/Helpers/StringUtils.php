<?php

namespace Sysgaming\AggregatorSdkPhp\Helpers;

class StringUtils {

    static function camelToSnake($str)
    {
        return self::camelToUnderScore($str, '-');
    }

    static function camelToUnderScore($str, $separator = '_')
    {

        if (empty($str))
            return $str;

        $str = lcfirst($str);
        $str = preg_replace('/[A-Z]/', $separator . '$0', $str);

        return strtolower($str);

    }

}