<?php

namespace Sysgaming\AggregatorSdkPhp\Exceptions;

class UserCantPlayException extends AggregatorGamingException {

    /**
     * UserCantPlayException constructor.
     * @param string $message
     */
    public function __construct($message = "")
    {
        parent::__construct($message);
    }

}