<?php

namespace Sysgaming\AggregatorSdkPhp\Auth;

interface AggregatorSignatureMaker {

    /**
     * @param $payload
     * @return string
     */
    function sign($payload);

}