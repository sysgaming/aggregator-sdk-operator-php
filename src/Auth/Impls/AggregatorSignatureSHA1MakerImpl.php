<?php

namespace Sysgaming\AggregatorSdkPhp\Auth\Impls;

use Sysgaming\AggregatorSdkPhp\Auth\AggregatorRequestSignatureHolder;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureChecker;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureMaker;
use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;
use Sysgaming\AggregatorSdkPhp\Exceptions\InvalidSignatureException;

class AggregatorSignatureSHA1MakerImpl implements AggregatorSignatureMaker
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

    function sign($payload) {

        return sha1($payload . '.' . $this->secret);

    }


}