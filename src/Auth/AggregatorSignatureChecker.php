<?php

namespace Sysgaming\AggregatorSdkPhp\Auth;

use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorHttpInboundRequest;
use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;

interface AggregatorSignatureChecker {

    /**
     * @param $request AggregatorHttpInboundRequest
     * @throws AggregatorGamingException
     */
    function validate($request);

}