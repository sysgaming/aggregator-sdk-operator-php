<?php

namespace Sysgaming\AggregatorSdkPhp\Auth\Impls;

use Sysgaming\AggregatorSdkPhp\Auth\AggregatorRequestSignatureHolder;
use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureChecker;
use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;
use Sysgaming\AggregatorSdkPhp\Exceptions\InvalidSignatureException;

class AggregatorSignatureBasicAuthCheckerImpl implements AggregatorSignatureChecker
{

    private $signatureHolder;
    private $credentialId;
    private $credentialValue;

    /**
     * AggregatorSignatureCheckerImpl constructor.
     * @param $signatureHolder AggregatorRequestSignatureHolder
     * @param $credentialId string
     * @param $credentialValue string
     */
    public function __construct($signatureHolder, $credentialId, $credentialValue)
    {
        $this->signatureHolder = $signatureHolder;
        $this->credentialId = $credentialId;
        $this->credentialValue = $credentialValue;
    }


    /**
     * @param $payload string
     * @throws AggregatorGamingException
     */
    function validate($payload)
    {

        $user = $this->signatureHolder->getUser();
        $password = $this->signatureHolder->getPassword();

        if(
            !$user || !$password
            || $user != $this->credentialId
            || $password != $this->credentialValue
        )
            throw new InvalidSignatureException();

    }

}