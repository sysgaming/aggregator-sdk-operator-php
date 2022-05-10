<?php

namespace Sysgaming\AggregatorSdkPhp\Exceptions;

class NotEnoughMoneyException extends AggregatorGamingException {

    /**
     * NotEnoughMoneyException constructor.
     * @param string $message
     */
    public function __construct($message = "")
    {
        parent::__construct($message);
    }

}