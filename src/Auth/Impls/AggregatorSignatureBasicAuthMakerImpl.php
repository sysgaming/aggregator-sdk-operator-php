<?php

namespace Sysgaming\AggregatorSdkPhp\Auth\Impls;

use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureHolder;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureChecker;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureMaker;
use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;
use Sysgaming\AggregatorSdkPhp\Exceptions\InvalidSignatureException;

class AggregatorSignatureBasicAuthMakerImpl implements AggregatorSignatureMaker
{
    private $credentialId;
    private $credentialValue;

    /**
     * AggregatorSignatureCheckerImpl constructor.
     * @param $credentialId
     * @param $credentialValue
     */
    public function __construct($credentialId, $credentialValue)
    {
        $this->credentialId = $credentialId;
        $this->credentialValue = $credentialValue;
    }

    function sign($payload) {

        return $this->credentialId . ':' . $this->credentialValue;

    }


}