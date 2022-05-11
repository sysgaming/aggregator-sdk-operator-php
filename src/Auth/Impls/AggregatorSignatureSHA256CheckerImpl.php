<?php

namespace Sysgaming\AggregatorSdkPhp\Auth\Impls;

use Sysgaming\AggregatorSdkPhp\Auth\AggregatorRequestSignatureHolder;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureChecker;
use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;
use Sysgaming\AggregatorSdkPhp\Exceptions\InvalidSignatureException;

class AggregatorSignatureSHA256CheckerImpl implements AggregatorSignatureChecker
{

    private $signatureHolder;
    private $secret;

    /**
     * AggregatorSignatureCheckerImpl constructor.
     * @param $signatureHolder AggregatorRequestSignatureHolder
     * @param $secret
     */
    public function __construct($signatureHolder, $secret)
    {
        $this->signatureHolder = $signatureHolder;
        $this->secret = $secret;
    }


    /**
     * @param $payload string
     * @throws AggregatorGamingException
     */
    function validate($payload)
    {

        $signature = $this->signatureHolder->getSignature();

        if( !$signature || hash('sha256', $payload . "." . $this->secret) != $signature )
            throw new InvalidSignatureException();

    }

}