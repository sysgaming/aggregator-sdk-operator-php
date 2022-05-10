<?php

namespace Sysgaming\AggregatorSdkPhp\Exceptions;

class TransactionConflictException extends AggregatorGamingException {

    /**
     * TransactionConflictException constructor.
     * @param string $message
     */
    public function __construct($message = "")
    {
        parent::__construct($message);
    }

}