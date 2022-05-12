<?php

namespace Sysgaming\AggregatorSdkPhp\Auth\Impls;

use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureHolder;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureChecker;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorHttpInboundRequest;
use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;
use Sysgaming\AggregatorSdkPhp\Exceptions\InvalidSignatureException;

class AggregatorSignatureSHA1CheckerImpl implements AggregatorSignatureChecker
{

    private $secret;

    /**
     * AggregatorSignatureCheckerImpl constructor.
     * @param $secret
     */
    public function __construct($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @param $request AggregatorHttpInboundRequest
     * @throws AggregatorGamingException
     */
    function validate($request)
    {

        $payload = $request->getContents();
        $signatureHolder = $request->getSignatureHolder();

        $signature = $signatureHolder->getSignature();

        if( !$signature || sha1($payload . "." . $this->secret) != $signature )
            throw new InvalidSignatureException();

    }

}