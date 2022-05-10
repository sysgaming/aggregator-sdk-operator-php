<?php

namespace Sysgaming\AggregatorSdkPhp\Exceptions;

class InvalidTokenException extends AggregatorGamingException {

    /**
     * InvalidTokenException constructor.
     * @param string $message
     */
    public function __construct($message = "")
    {
        parent::__construct($message);
    }

}