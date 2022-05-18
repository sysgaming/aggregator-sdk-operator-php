<?php

namespace Sysgaming\AggregatorSdkPhp\Auth\Impls;

use Sysgaming\AggregatorSdkPhp\Auth\AggregatorSignatureChecker;
use Sysgaming\AggregatorSdkPhp\Dtos\Inbound\AggregatorHttpInboundRequest;
use Sysgaming\AggregatorSdkPhp\Exceptions\AggregatorGamingException;
use Sysgaming\AggregatorSdkPhp\Exceptions\InvalidSignatureException;

class AggregatorSignatureBasicAuthCheckerImpl implements AggregatorSignatureChecker
{

    private $credentialId;
    private $credentialValue;

    /**
     * AggregatorSignatureCheckerImpl constructor.
     * @param $credentialId string
     * @param $credentialValue string
     */
    public function __construct($credentialId, $credentialValue)
    {
        $this->credentialId = $credentialId;
        $this->credentialValue = $credentialValue;
    }

    /**
     * @param $request AggregatorHttpInboundRequest
     * @throws AggregatorGamingException
     */
    function validate($request)
    {

        $signatureHolder = $request->getSignatureHolder();

        $user = $signatureHolder->getUser();
        $password = $signatureHolder->getPassword();

        if(
            !$user || !$password
            || $user != $this->credentialId
            || $password != $this->credentialValue
        )
            throw new InvalidSignatureException();

    }

}