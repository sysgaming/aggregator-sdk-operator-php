<?php

namespace Sysgaming\AggregatorSdkPhp\Helpers;

interface JsonHandler {

    /**
     * @param $value array|object
     * @return string
     */
    function jsonEncode($value);

    /**
     * @param $raw string
     * @return array
     */
    function jsonDecode($raw);

}