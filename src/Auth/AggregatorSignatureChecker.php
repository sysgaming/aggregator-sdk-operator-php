<?php

namespace Sysgaming\AggregatorSdkPhp\Auth;

use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;

interface AggregatorSignatureChecker {

    /**
     * @param $payload string
     * @throws AggregatorGamingException
     */
    function validate($payload);

}