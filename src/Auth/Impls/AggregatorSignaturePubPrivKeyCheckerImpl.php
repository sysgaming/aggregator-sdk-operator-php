<?php

namespace Sysgaming\AggregatorSdkPhp\Auth\Impls;

use Sysgaming\AggregatorSdkPhp\Auth\AggregatorRequestSignatureHolder;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureChecker;
use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;
use Sysgaming\AggregatorSdkPhp\Exceptions\InvalidSignatureException;

class AggregatorSignaturePubPrivKeyCheckerImpl implements AggregatorSignatureChecker
{

    private $signatureHolder;
    private $publicKey;

    /**
     * AggregatorSignatureCheckerImpl constructor.
     * @param $signatureHolder AggregatorRequestSignatureHolder
     * @param $publicKey string
     */
    public function __construct($signatureHolder, $publicKey)
    {
        $this->signatureHolder = $signatureHolder;
        $this->publicKey = $publicKey;
    }


    /**
     * @param $payload string
     * @throws AggregatorGamingException
     */
    function validate($payload)
    {

        $signature = $this->signatureHolder->getSignature();

        if( !$signature )
            throw new InvalidSignatureException();

        $openPublicKey = openssl_pkey_get_public($this->publicKey);

        $valid = openssl_verify($payload, $signature, $openPublicKey, 'RSA-SHA256');

        if( $valid != 1 )
            throw new InvalidSignatureException();

    }

}