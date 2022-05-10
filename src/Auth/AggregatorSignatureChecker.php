<?php

namespace Sysgaming\AggregatorSdkPhp\Auth;

interface AggregatorSignatureChecker {

    /**
     * @param $payload
     * @return string
     */
    function validate($payload);

}