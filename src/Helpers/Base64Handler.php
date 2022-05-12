<?php

namespace Sysgaming\AggregatorSdkPhp\Helpers;

interface Base64Handler {

    /**
     * @param $str string
     * @return string
     */
    function base64Encode($str);

    /**
     * @param $str string
     * @return string
     */
    function base64Decode($str);

}