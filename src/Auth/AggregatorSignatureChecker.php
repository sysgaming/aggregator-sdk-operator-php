<?php

namespace Sysgaming\AggregatorSdkPhp\Auth;

use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorHttpInboundRequest;
use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;

interface AggregatorSignatureChecker {

    /**
     * @param $request AggregatorHttpInboundRequest
     * @throws AggregatorGamingException
     */
    function validate($request);

}