<?php

namespace Sysgaming\AggregatorSdkPhp\Auth\Impls;

use Sysgaming\AggregatorSdkPhp\Auth\AggregatorRequestSignatureHolder;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureChecker;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureMaker;
use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;
use Sysgaming\AggregatorSdkPhp\Exceptions\InvalidSignatureException;

class AggregatorSignaturePubPrivKeyMakerImpl implements AggregatorSignatureMaker
{

    private $strPrivateKey;

    /**
     * AggregatorSignaturePubPrivKeyMakerImpl constructor.
     * @param $strPrivateKey string
     */
    public function __construct($strPrivateKey)
    {
        $this->strPrivateKey = $strPrivateKey;
    }


    function sign($payload) {

        $privateKeyId = openssl_pkey_get_private($this->strPrivateKey);

        openssl_sign($payload, $signature, $privateKeyId, 'RSA-SHA256');

        return $signature;

    }


}