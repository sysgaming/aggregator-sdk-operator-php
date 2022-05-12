<?php

namespace Sysgaming\AggregatorSdkPhp\Auth;

interface AggregatorSignatureMaker {

    /**
     * @param $payload string
     * @return string
     */
    function sign($payload);

}