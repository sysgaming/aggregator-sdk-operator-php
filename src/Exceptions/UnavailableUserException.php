<?php

namespace Sysgaming\AggregatorSdkPhp\Exceptions;

class UnavailableUserException extends AggregatorGamingException {

    /**
     * UnavailableUserException constructor.
     * @param string $message
     */
    public function __construct($message = "")
    {
        parent::__construct($message);
    }

}