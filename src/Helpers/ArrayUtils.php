<?php

namespace Sysgaming\AggregatorSdkPhp\Helpers;

class ArrayUtils {

    static function get($key, $array) {

        if( is_null($key)
            || is_null($array)
            || count($array) == 0
            || !isset($array[$key])
        )
            return null;

        return $array[$key];

    }

}