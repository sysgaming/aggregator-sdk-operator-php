<?php

namespace Sysgaming\AggregatorSdkPhp\Exceptions;

class InvalidSignatureException extends AggregatorGamingException {

    /**
     * InvalidSignatureException constructor.
     * @param string $message
     */
    public function __construct($message = "")
    {
        parent::__construct($message);
    }

}