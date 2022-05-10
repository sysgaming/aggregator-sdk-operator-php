<?php

namespace Sysgaming\AggregatorSdkPhp\Exceptions;

class CurrencyNotSupportedException extends AggregatorGamingException {

    /**
     * CurrencyNotSupportedException constructor.
     * @param string $message
     */
    public function __construct($message = "")
    {
        parent::__construct($message);
    }

}