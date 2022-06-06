<?php

namespace Sysgaming\AggregatorSdkPhp\Exceptions;

class UnavailablePlayerException extends AggregatorGamingException {

    /**
     * UnavailableUserException constructor.
     * @param string $message
     */
    public function __construct($message = "")
    {
        parent::__construct($message);
    }

}