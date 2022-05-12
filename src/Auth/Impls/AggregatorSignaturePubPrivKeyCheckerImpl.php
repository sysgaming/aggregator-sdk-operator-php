<?php

namespace Sysgaming\AggregatorSdkPhp\Auth\Impls;

use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureHolder;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureChecker;
use Sysgaming\AggregatorSdkPhp\Dtos\Outbound\AggregatorHttpInboundRequest;
use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;
use Sysgaming\AggregatorSdkPhp\Exceptions\InvalidSignatureException;

class AggregatorSignaturePubPrivKeyCheckerImpl implements AggregatorSignatureChecker
{

    private $strPublicKey;

    /**
     * AggregatorSignatureCheckerImpl constructor.
     * @param $strPublicKey string
     */
    public function __construct($strPublicKey)
    {
        $this->strPublicKey = $strPublicKey;
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

        if( !$signature )
            throw new InvalidSignatureException();

        $openPublicKey = openssl_pkey_get_public($this->strPublicKey);

        $valid = openssl_verify($payload, $signature, $openPublicKey, 'RSA-SHA256');

        if( $valid != 1 )
            throw new InvalidSignatureException();

    }

}