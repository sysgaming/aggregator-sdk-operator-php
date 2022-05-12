<?php

namespace Sysgaming\AggregatorSdkPhp\Helpers\Impls;

use Sysgaming\AggregatorSdkPhp\Helpers\JsonHandler;

class JsonHandlerImpl implements JsonHandler
{

    /**
     * @param $value array|object
     * @return string
     */
    function jsonEncode($value)
    {

        return json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    }

    /**
     * @param $raw string
     * @return array
     */
    function jsonDecode($raw)
    {

        return json_decode($raw, true);

    }
}