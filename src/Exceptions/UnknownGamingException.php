<?php

namespace Sysgaming\AggregatorSdkPhp\Exceptions;

class UnknownGamingException extends AggregatorGamingException {

    /**
     * UnknownGamingException constructor.
     * @param string $message
     */
    public function __construct($message = "")
    {
        parent::__construct($message);
    }

}