<?php

namespace Sysgaming\AggregatorSdkPhp\Helpers;

class ArrayUtils {

    static function get($key, $array) {

        if( is_null($key) || !isset($array[$key]) )
            return null;

        return $array[$key];

    }

}