<?php

namespace Sysgaming\AggregatorSdkPhp\Helpers\Impls;

use Sysgaming\AggregatorSdkPhp\Helpers\Base64Handler;

class Base64HandlerImpl implements Base64Handler
{

    /**
     * @param $str string
     * @return string
     */
    function base64Encode($str) {

        return base64_encode($str);

    }

    /**
     * @param $str string
     * @return string
     */
    function base64Decode($str) {

        return base64_decode($str);

    }
}